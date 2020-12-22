<!-- BEGIN: Footer-->
<footer class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
    <div class="footer-copyright">
        <div class="container">
            <span>&copy; {{ now()->year }} <a href="http://hrd.egat.co.th/hrdweb/" target="_blank">ฝ่ายพัฒนาศักยภาพทรัพยากรบุคคลและคุณภาพ</a></span>
            <span class="right hide-on-small-only">ออกแบบและพัฒนาระบบโดย : นายวสุธร ลี้ชาญกุล วก.7 หขป-ห. กกผ-ห. &nbsp;<i class="tiny mdi mdi-phone-forward"></i> 65712 &nbsp;<i class="tiny mdi mdi-email-send"></i> 593595@egat.co.th</a></span>
        </div>
    </div>
</footer>
<!-- END: Footer-->
