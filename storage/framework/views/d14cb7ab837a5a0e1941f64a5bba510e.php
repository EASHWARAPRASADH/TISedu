<?php
    $setting = generalSetting();
    if(isset($setting->copyright_text)){
    $copyright_text = $setting->copyright_text;
    }else{
    $copyright_text = "Copyright © " . date('Y') . " All rights reserved by Codethemes";

    }
?>

</div>
</div>
<?php if(moduleStatusCheck('Lead')==true): ?>
    <?php $__currentLoopData = $reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div id="fullCalReminderModal_<?php echo e($item->id); ?>" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalTitle" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span> <span class="sr-only"><?php echo app('translator')->get('common.close'); ?></span>
                    </button>
                </div>
                <div class="modal-body text-center">
                <?php echo $__env->make('lead::lead_calender', ['event' => $item], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('common.close'); ?></button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php if(config('app.app_sync')): ?>
    <a target="_blank" href="https://aorasoft.com" class="float_button"> <i class="ti-shopping-cart-full"></i>
        <h3>Purchase InfixEdu</h3>
    </a>
<?php endif; ?>
<div class="has-modal modal fade" id="showDetaildModal">
    <div class="modal-dialog modal-dialog-centered" id="modalSize">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="showDetaildModalTile"><?php echo app('translator')->get('system_settings.new_client_information'); ?></h4>
                <button type="button" class="close icons" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="showDetaildModalBody">

            </div>
        </div>
    </div>
</div>
<!--  Start Modal Area -->
<div class="modal fade invoice-details" id="showDetaildModalInvoice">
    <div class="modal-dialog large-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('common.add_invoice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="showDetaildModalBodyInvoice">
            </div>
        </div>
    </div>
</div>
<!--================Footer Area ================= -->
<footer class="footer-area new-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <?php if(Auth::check()): ?>
                    <p><?php echo $copyright_text; ?> </p>
                <?php else: ?>
                    <p><?php echo $copyright_text; ?> </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<!-- ================End Footer Area ================= -->

<script>
    window.jsLang = function(key, replace) {
        let translation = true

        let json_file = $.parseJSON(window._translations[window._locale]['json'])
        translation = json_file[key]
            ? json_file[key]
            : key


        $.each(replace, (value, key) => {
            translation = translation.replace(':' + key, value)
        })

        return translation
    }
    window.trans = function(key, replace) {
        let translation = true

        let json_file = $.parseJSON(window._translations[window._locale]['json'])
        translation = json_file[key]
            ? json_file[key]
            : key


        $.each(replace, (value, key) => {
            translation = translation.replace(':' + key, value)
        })
        return translation
    }
    
</script>

<script src="<?php echo e(asset('backEnd/')); ?>/vendors/js/jquery-ui.js"></script>
<script src="<?php echo e(asset('backEnd/')); ?>/vendors/js/popper.js"></script>

<script src="<?php echo e(asset('backEnd/assets/js/metisMenu.js')); ?>"></script>

<?php if(userRtlLtl() ==1): ?>
<script src="<?php echo e(asset('backEnd/assets/js/bootstrap.rtl.min.js')); ?>"></script>
<?php else: ?>
<script src="<?php echo e(asset('backEnd/assets/js/bootstrap.min.js')); ?>"></script>
<?php endif; ?>
<script src="<?php echo e(asset('backEnd/')); ?>/vendors/js/nice-select.min.js"></script>

<script src="<?php echo e(asset('backEnd/')); ?>/vendors/js/jquery.magnific-popup.min.js"></script>

<script src="<?php echo e(asset('backEnd/')); ?>/vendors/js/raphael-min.js"></script>
<script src="<?php echo e(asset('backEnd/')); ?>/vendors/js/morris.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('backEnd/')); ?>/vendors/js/toastr.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('backEnd/')); ?>/vendors/js/moment.min.js"></script>

<?php if(moduleStatusCheck('WhatsappSupport')): ?>
<script src="<?php echo e(asset('whatsapp-support/scripts.js')); ?>"></script>
<?php endif; ?>


<script type="text/javascript" src="<?php echo e(asset('backEnd/')); ?>/js/jquery.validate.min.js"></script>


<script src="<?php echo e(asset('backEnd/')); ?>/js/main.js"></script>

<script src="<?php echo e(asset('backEnd/')); ?>/js/custom.js"></script>
<script src="<?php echo e(asset('')); ?>/js/registration_custom.js"></script>
<script src="<?php echo e(asset('backEnd/')); ?>/js/developer.js"></script>
<script src="<?php echo e(url('Modules\Wallet\Resources\assets\js\wallet.js')); ?>"></script>
<script>
    $('.close_modal').on('click', function() {
        $('.custom_notification').removeClass('open_notification');
    });
    $('.notification_icon').on('click', function() {
        $('.custom_notification').addClass('open_notification');
    });
    $(document).click(function(event) {
        if (!$(event.target).closest(".custom_notification").length) {
            $("body").find(".custom_notification").removeClass("open_notification");
        }
    });

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : (event.keyCode);
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
<script src="<?php echo e(asset('backEnd/')); ?>/js/search.js"></script>

<?php echo Toastr::message(); ?>

<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<script src="<?php echo e(asset('chat/js/custom.js')); ?>"></script>

<?php echo $__env->yieldContent('script'); ?>
<?php echo $__env->yieldPushContent('script'); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>

<?php if(moduleStatusCheck('Lead')==true): ?>

    <?php $__currentLoopData = $reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
           $reminder_date_time=Carbon::parse($item->date_time)->format('Y-m-d').' '.$item->time;
        ?>
    <script>
        setInterval(() => {
            let id = <?php echo e($item->id); ?>;
            let reminder_date = '<?php echo e($reminder_date_time); ?>';
            let current_time = moment().format('YYYY-MM-DD HH:mm:ss');

            let current_time_integer = Date.parse(current_time);
            let reminder_integer = Date.parse(reminder_date);
            if(current_time_integer==reminder_integer) {
                $('#fullCalReminderModal_'+id).modal('show');
            }
        }, 1000);
    </script>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<!-- Digital Voice Secretary Widget -->
<style>
#voice-secretary-btn {
    position: fixed;
    bottom: 20px;
    left: 20px;
    width: 60px;
    height: 60px;
    background-color: #415094;
    color: white;
    border-radius: 50%;
    text-align: center;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
    cursor: pointer;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    transition: transform 0.2s, background-color 0.2s;
}
#voice-secretary-btn:hover {
    transform: scale(1.1);
}
.voice-listening {
    background-color: #f44336 !important;
    animation: pulse 1.5s infinite;
}
@keyframes pulse {
    0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(244, 67, 54, 0.7); }
    70% { transform: scale(1.1); box-shadow: 0 0 0 15px rgba(244, 67, 54, 0); }
    100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(244, 67, 54, 0); }
}
#voice-status {
    position: fixed;
    bottom: 90px;
    left: 20px;
    background: #333;
    color: #fff;
    padding: 10px 15px;
    border-radius: 8px;
    font-size: 14px;
    display: none;
    z-index: 9999;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
}
</style>

<?php if(Auth::check() && Auth::user()->role_id == 1): ?>
<div id="voice-status">🎙️ Listening for commands...</div>
<div id="voice-secretary-btn" title="Digital Voice Secretary">
    <i class="ti-microphone"></i>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const voiceBtn = document.getElementById("voice-secretary-btn");
    const voiceStatus = document.getElementById("voice-status");
    
    if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
        voiceBtn.style.display = 'none'; // Not supported
        return;
    }

    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const recognition = new SpeechRecognition();
    recognition.continuous = false;
    recognition.interimResults = false;
    recognition.lang = 'en-US';

    let isListening = false;

    voiceBtn.addEventListener("click", () => {
        if (isListening) {
            recognition.stop();
        } else {
            recognition.start();
        }
    });

    recognition.onstart = function() {
        isListening = true;
        voiceBtn.classList.add("voice-listening");
        voiceStatus.style.display = "block";
        voiceStatus.innerText = "🎙️ Listening... Say 'Dashboard', 'Timetable', etc.";
    };

    recognition.onresult = function(event) {
        let transcript = event.results[0][0].transcript.toLowerCase();
        voiceStatus.innerText = "🗣️ Command: " + transcript;
        
        setTimeout(() => {
            if(transcript.includes("dashboard")) {
                window.location.href = "<?php echo e(route('admin-dashboard')); ?>";
            } else if(transcript.includes("timetable") || transcript.includes("schedule")) {
                window.location.href = "<?php echo e(route('automatedtimetable.editor')); ?>";
            } else if(transcript.includes("attendance")) {
                window.location.href = "<?php echo e(route('student_attendance')); ?>";
            } else if(transcript.includes("student list")) {
                window.location.href = "<?php echo e(route('student_list')); ?>";
            } else if(transcript.includes("fees") || transcript.includes("payment")) {
                window.location.href = "<?php echo e(route('fees.fees-invoice-list')); ?>";
            } else {
                voiceStatus.innerText = "❌ Command not recognized";
                setTimeout(() => { voiceStatus.style.display = "none"; }, 2000);
            }
        }, 1000);
    };

    recognition.onerror = function(event) {
        voiceStatus.innerText = "⚠️ Error: " + event.error;
        console.error("Speech Recognition Error: ", event.error);
        stopListeningUi();
    };

    recognition.onend = function() {
        stopListeningUi();
    };

    function stopListeningUi() {
        isListening = false;
        voiceBtn.classList.remove("voice-listening");
        setTimeout(() => { 
            if(!isListening) voiceStatus.style.display = "none"; 
        }, 2000);
    }
});
</script>
<?php endif; ?>

</body>
</html><?php /**PATH /Users/eash/Downloads/erpv2/resources/views/backEnd/partials/footer.blade.php ENDPATH**/ ?>