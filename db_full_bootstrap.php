<?php
/**
 * InfixEdu Full Bootstrap & Mock Data Generator
 * Target: School ID 1 (u841409365_erpv0)
 * Run: php artisan tinker db_full_bootstrap.php
 */

use App\SmClass;
use App\SmSection;
use App\SmSubject;
use App\SmStudent;
use App\SmFeesMaster;
use App\SmFeesAssign;
use App\SmFeesPayment;
use App\SmExamType;
use App\SmResultStore;
use App\SmStudentAttendance;
use App\Models\StudentRecord;
use Illuminate\Support\Facades\DB;

echo "🚀 Starting Full Bootstrap for School 1...\n";

$schoolId = 1;
$academicId = 1;

// 1. Structural Bootstrap: Classes, Sections, Subjects
$classes = ['Class 10', 'Class 11', 'Class 12'];
$sections = ['Section A', 'Section B'];
$subjects = ['Mathematics', 'Science', 'English', 'History', 'Arts'];

$sectionIds = [];
foreach ($sections as $secName) {
    $sec = SmSection::firstOrCreate(['section_name' => $secName, 'school_id' => $schoolId], ['academic_id' => $academicId]);
    $sectionIds[] = $sec->id;
}

$classIds = [];
foreach ($classes as $className) {
    $cls = SmClass::firstOrCreate(['class_name' => $className, 'school_id' => $schoolId], ['academic_id' => $academicId]);
    $classIds[] = $cls->id;
    // Link section A as default
    DB::table('sm_class_sections')->updateOrInsert(['class_id' => $cls->id, 'section_id' => $sectionIds[0], 'school_id' => $schoolId], ['academic_id' => $academicId]);
}

$subjectIds = [];
foreach ($subjects as $subName) {
    $sub = SmSubject::firstOrCreate(['subject_name' => $subName, 'school_id' => $schoolId], ['subject_code' => strtoupper(substr($subName, 0, 3)), 'subject_type' => 'T', 'academic_id' => $academicId]);
    $subjectIds[] = $sub->id;
}

// 2. Fees Setup
$groupId = DB::table('sm_fees_groups')->insertOrIgnore(['name' => 'General Fees', 'school_id' => $schoolId, 'academic_id' => $academicId]);
if (!$groupId) $groupId = DB::table('sm_fees_groups')->where('name', 'General Fees')->value('id');

$typeId = DB::table('sm_fees_types')->insertOrIgnore(['name' => 'Tuition Fee', 'school_id' => $schoolId, 'academic_id' => $academicId]);
if (!$typeId) $typeId = DB::table('sm_fees_types')->where('name', 'Tuition Fee')->value('id');

$master = SmFeesMaster::firstOrCreate(['fees_group_id' => $groupId, 'fees_type_id' => $typeId, 'school_id' => $schoolId], ['amount' => 1200, 'academic_id' => $academicId]);

// 3. Exam Setup
$exam = SmExamType::firstOrCreate(['title' => 'First Term', 'school_id' => $schoolId], ['academic_id' => $academicId]);

// 4. Enroll Students & Add Transactional Data
for ($i = 1; $i <= 30; $i++) {
    $classIdx = floor(($i-1) / 10);
    $clsId = $classIds[$classIdx];
    $secId = $sectionIds[0];

    // Create Student User
    $userId = DB::table('users')->insertGetId([
        'full_name' => "Student $i",
        'email' => "student$i@infix.com",
        'username' => "student$i",
        'password' => bcrypt('123456'),
        'role_id' => 2,
        'school_id' => $schoolId,
        'active_status' => 1,
        'is_registered' => 1
    ]);

    $student = new SmStudent();
    $student->user_id = $userId;
    $student->admission_no = 1000 + $i;
    $student->first_name = "Student";
    $student->last_name = "$i";
    $student->full_name = "Student $i";
    $student->school_id = $schoolId;
    $student->academic_id = $academicId;
    $student->save();

    $record = new StudentRecord();
    $record->student_id = $student->id;
    $record->class_id = $clsId;
    $record->section_id = $secId;
    $record->school_id = $schoolId;
    $record->academic_id = $academicId;
    $record->is_default = 1;
    $record->save();

    // Fees Assignment & random Payment
    $assign = new SmFeesAssign();
    $assign->student_id = $student->id;
    $assign->fees_master_id = $master->id;
    $assign->school_id = $schoolId;
    $assign->academic_id = $academicId;
    $assign->record_id = $record->id;
    $assign->student_record_id = $record->id;
    $assign->save();

    if ($i % 2 == 0) { // Pay 50% of them
        $pay = new SmFeesPayment();
        $pay->amount = $master->amount;
        $pay->payment_date = date('Y-m-d');
        $pay->payment_mode = 'Cash';
        $pay->assign_id = $assign->id;
        $pay->fees_type_id = $typeId;
        $pay->student_id = $student->id;
        $pay->record_id = $record->id;
        $pay->school_id = $schoolId;
        $pay->academic_id = $academicId;
        $pay->save();
    }

    // Exam Marks (1 subject per student for brevity, or all 5)
    foreach ($subjectIds as $subId) {
        $marks = new SmResultStore();
        $marks->student_id = $student->id;
        $marks->exam_type_id = $exam->id;
        $marks->subject_id = $subId;
        $marks->class_id = $clsId;
        $marks->section_id = $secId;
        $marks->total_marks = rand(70, 98);
        $marks->total_gpa_point = 5.0;
        $marks->total_gpa_grade = 'A+';
        $marks->school_id = $schoolId;
        $marks->academic_id = $academicId;
        $marks->save();
    }

    // Attendance (Last 10 days)
    for ($d = 1; $d <= 10; $d++) {
        $att = new SmStudentAttendance();
        $att->student_id = $student->id;
        $att->attendance_date = date('Y-m-d', strtotime("-$d days"));
        $att->attendance_type = 'P';
        $att->school_id = $schoolId;
        $att->academic_id = $academicId;
        $att->record_id = $record->id;
        $att->student_record_id = $record->id;
        $att->class_id = $clsId;
        $att->section_id = $secId;
        $att->save();
    }
}

echo "✨ Full Bootstrap Complete! Created 3 Classes, 5 Subjects, and 30 Students with complete records.\n";
