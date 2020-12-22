{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Home Page')

{{-- page styles --}}
@section('page-style')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/intro.css')}}">
@endsection

{{-- page content --}}
<?php
    foreach($data as $value){
        // ประกาศตัวแปรไว้ก่อนใช้งานด้านบนนี้เลย สำหรับ checkbox module ต่างๆ ด้านล่าง พร้อมกับใช้ foreach จากด้านบนเลย (ไม่ต้องไปประกาศแทรกใน HTML)
        $announcement_module = '';
        $presentation_round_module = '';
        $prize_results_module = '';

        $site_maintenance_module = '';

        if(isset($data['systemsettingdata'])){
            $systemsettingdata = $data['systemsettingdata'];
            foreach($systemsettingdata as $systemsettingdata_item){
                $paramno = $systemsettingdata_item->paramno;
                $paramtype = $systemsettingdata_item->paramtype;
                $paramval = $systemsettingdata_item->paramval;

                if($paramno == 'S012' && $paramtype == 'ANNOUNCEMENT' && $paramval == 'Enable'){
                    $announcement_module = 'enable';
                }elseif($paramno == 'S012' && $paramtype == 'PRESENT' && $paramval == 'Enable'){
                    $presentation_round_module = 'enable';
                }elseif($paramno == 'S012' && $paramtype == 'PRIZE' && $paramval == 'Enable'){
                    $prize_results_module = 'enable';
                }elseif($paramno == 'S012' && $paramtype == 'MAINTENANCE' && $paramval == 'Enable'){
                    $site_maintenance_module = 'Y';
                }else{}
            }
        }

        // if(isset) เพื่อกัน ERROR undefine data variable และประกาศเรียก array $data ให้พร้อม สำหรับการใช้งานใน foreach
        if(isset($data['coordinatorlistdata'])){
            $coordinatorlistdata = $data['coordinatorlistdata'];
        }
        if(isset($data['qccpasstopresentroundlist'])){
            $qccpasstopresentroundlist = $data['qccpasstopresentroundlist'];
        }
        if(isset($data['qccwonlist'])){
            $qccwonlist = $data['qccwonlist'];
        }

        // สำหรับแสดงค่า SYSYEAR จาก Database
        if(isset($data['qccsystemyear'])){
            $qccsystemyear = $data['qccsystemyear'];
        }
        // สำหรับแสดงค่า SYS STRT DATE จาก Database
        if(isset($data['qccsystemstrtdate'])){
            $qccsystemstrtdate = $data['qccsystemstrtdate'];
        }
        // สำหรับแสดงค่า SYS END DATE จาก Database
        if(isset($data['qccsystemenddate'])){
            $qccsystemenddate = $data['qccsystemenddate'];
        }
    }

    // ใช้ explode เพื่อกระจายค่าเป็น array แล้วเรียกใช้ทีละตัว ก่อนนำค่ามารวมเข้ากันเป็นอีกตัวแปรเพื่อนำไปแสดงผล
    $qccsystemstrtdate_array = explode("/", $qccsystemstrtdate);
    $strt_dd = $qccsystemstrtdate_array[0];
    $strt_mm = $qccsystemstrtdate_array[1];
    $strt_yyyy = $qccsystemstrtdate_array[2]+543;
    $sysstrtdate = $strt_dd."/".$strt_mm."/".$strt_yyyy;

    $qccsystemenddate_array = explode("/", $qccsystemenddate);
    $end_dd = $qccsystemenddate_array[0];
    $end_mm = $qccsystemenddate_array[1];
    $end_yyyy = $qccsystemenddate_array[2]+543;
    $sysenddate = $end_dd."/".$end_mm."/".$end_yyyy;
//    {{-- dd ($test); --}}
//    echo $test[2]+543;
?>

@section('content')
@if(session()->get('usertype_S012') == 'A' && $site_maintenance_module == 'Y')
    <div class="card-panel card-alert card gradient-45deg-red-pink">
        <h1 class="card-title" style="font-size: 55px !important;"><font style="color: white;">Attention all Administrators</font></h1>
        <p style="color:white; font-size:160%;">We are undergoing a bit of scheduled maintenance all users except admin are not allow to access this site.</p>
        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif

@if($announcement_module == 'enable')
    <div class="section">
        <div class="card">
            <div class="card-content">
                <p class="caption mb-0">
                    {{-- ระบบลงทะเบียนผลงานกิจกรรมพัฒนาคุณภาพ กฟผ. ประจำปี {{ now()->year+543 }} เปิดตั้งแต่วันที่ --}}
                    ระบบลงทะเบียนผลงานกิจกรรมพัฒนาคุณภาพ กฟผ. ประจำปี {{ $qccsystemyear+543 }} เปิดตั้งแต่วันที่ {{ $sysstrtdate }} ถึง {{ $sysenddate }}
                </p>
            </div>
        </div>
    </div>
@endif

    <div id="popout" class="row">
        <div class="col s12">
            <ul class="collapsible popout" data-collapsible="accordion">
                <li class="active">
                    <div class="collapsible-header" tabindex="0"><i class="mdi mdi-account-tie" style="margin-top: -7px;"></i>ผู้ประสานงาน</div>
                    <div class="collapsible-body" style="">
                        <h6 class="mt-0">แผนกส่งเสริมคุณภาพ (หสค-ห.)</h6>
                        <table id="data-table-simple" class="display">
                            <thead>
                                <tr>
                                    <th class="center-align">#</th>
                                    <th class="center-align"><i class="mdi mdi-account-circle" style="margin-top: -7px;"></th>
                                    <th class="center-align">รหัสพนักงาน</th>
                                    <th class="center-align">ชื่อ-สกุล</th>
                                    <th class="center-align">ตำแหน่ง</th>
                                    <th class="center-align"><i class="mdi mdi-deskphone" style="margin-top: -7px;"></th>
                                    <th class="center-align"><i class="mdi mdi-email" style="margin-top: -7px;"></th>
                                    <th class="center-align"><i class="mdi mdi-map-marker" style="margin-top: -7px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($coordinatorlistdata))
                                @foreach ($coordinatorlistdata as $coordinatorlistdata_item)
                                    <tr>
                                        <td class="center-align">{{ $loop->iteration }}</td>
                                        <td class="center-align"><img class="responsive-img" width="38" style="border-radius: 50%;" src="{{ $coordinatorlistdata_item->users_pic }}" alt="avatar"></td>
                                        <td class="center-align">{{ $coordinatorlistdata_item->userid }}</td>
                                        <td class="center-align">{{ $coordinatorlistdata_item->users_fullname }}</td>
                                        <td class="center-align">{{ $coordinatorlistdata_item->pabbr }}</td>
                                        <td class="center-align">{{ $coordinatorlistdata_item->telname }}</td>
                                        <td class="center-align">{{ $coordinatorlistdata_item->email }}</td>
                                        <td class="center-align">ห้อง 496 อาคาร ท.100 {{ $coordinatorlistdata_item->stras }}</td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
        </div><!-- CLOSE col s12 -->
    </div><!-- CLOSE popout row -->

@if($prize_results_module == 'enable')
    <div id="popout" class="row">
        <div class="col s12">
            <ul class="collapsible popout" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header" tabindex="0"><i class="mdi mdi-trophy" style="margin-top: -7px;"></i><font color="red">ประกาศ !!</font>&nbsp;ผลงานพัฒนาปรับปรุงคุณภาพงาน กฟผ. ประจำปี {{ $qccsystemyear+543 }} (ระดับ Gold Silver Bronze)</div>
                    <div class="collapsible-body" style="">
                        <h6 class="mt-0"></h6>
                        <table id="data-table-simple" class="display">
                            <thead>
                                <tr>
                                    <th class="center-align">#</th>
                                    <th class="center-align">สายงาน</th>
                                    <th class="center-align">หน่วยงาน</th>
                                    <th class="center-align">เลขที่กลุ่ม</th>
                                    <th class="center-align">ชื่อกิจกรรม</th>
                                    <th class="center-align">ประเภทผลงาน</th>
                                    <th class="center-align">รางวัล</th>
                                    {{-- <th class="center-align"><i class="mdi mdi-trophy-award" style="margin-top: -7px;"></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($qccwonlist))
                                @foreach ($qccwonlist as $qccwonlist_item)
                                    <tr>
                                        <td class="center-align">{{ $loop->iteration }}</td>
                                        <td class="center-align">{{ $qccwonlist_item->longno }}</td>
                                        <td class="center-align">{{ $qccwonlist_item->fay }}</td>
                                        <td class="center-align">{{ $qccwonlist_item->group_id }}</td>
                                        <td class="center-align">{{ $qccwonlist_item->act_name }}</td>

                                        @if($qccwonlist_item->act_cat == 'เทคนิค')
                                            <td class="center-align"><span class="chip blue lighten-5"><span class="blue-text">{{ $qccwonlist_item->act_cat }}</span></span></td>
                                        @elseif($qccwonlist_item->act_cat == 'สำนักงาน')
                                            <td class="center-align"><span class="chip amber lighten-5"><span class="amber-text">{{ $qccwonlist_item->act_cat }}</span></span></td>
                                        @else
                                            <td class="center-align"></td>
                                        @endif

                                        @if($qccwonlist_item->act_prize == 'Gold')
                                            <td class="center-align"><button class="gradient-45deg-amber-amber btn waves-effect waves-light btn-floating btn-small tooltipped" data-position="bottom" data-tooltip="Gold"><i class="mdi mdi-trophy" style="margin-top: 1px;"></i></button></td>
                                        @elseif($qccwonlist_item->act_prize == 'Silver')
                                            <td class="center-align"><button class="gradient-45deg-blue-grey-blue-grey btn waves-effect waves-light btn-floating btn-small tooltipped" data-position="bottom" data-tooltip="Silver"><i class="mdi mdi-trophy-variant" style="margin-top: 1px;"></i></td>
                                        @elseif($qccwonlist_item->act_prize == 'Bronze')
                                            <td class="center-align"><button class="gradient-45deg-deep-orange-orange btn waves-effect waves-light btn-floating btn-small tooltipped" data-position="bottom" data-tooltip="Bronze"><i class="mdi mdi-trophy-award" style="margin-top: 1px;"></i></button></td>
                                        @else
                                            <td class="center-align"></td>
                                        @endif
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
        </div><!-- CLOSE col s12 -->
    </div><!-- CLOSE popout row -->
@endif

@if($presentation_round_module == 'enable')
    <div id="popout" class="row">
        <div class="col s12">
            <ul class="collapsible popout" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header" tabindex="0"><i class="mdi mdi-thumb-up" style="margin-top: -7px;"></i><font color="red">ประกาศ !!</font>&nbsp;ผลงานพัฒนาปรับปรุงคุณภาพงาน กฟผ. ประจำปี {{ $qccsystemyear+543 }} ที่ผ่านเข้ารอบการนำเสนอผลงาน</div>
                    <div class="collapsible-body" style="">
                        <h6 class="mt-0"></h6>
                        <table id="data-table-simple" class="display">
                            <thead>
                                <tr>
                                    <th class="center-align">#</th>
                                    <th class="center-align">สายงาน</th>
                                    <th class="center-align">หน่วยงาน</th>
                                    <th class="center-align">เลขที่กลุ่ม</th>
                                    <th class="center-align">ชื่อกิจกรรม</th>
                                    <th class="center-align">ประเภทผลงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($qccpasstopresentroundlist))
                                @foreach ($qccpasstopresentroundlist as $qccpasstopresentroundlist_item)
                                    <tr>
                                        <td class="center-align">{{ $loop->iteration }}</td>
                                        <td class="center-align">{{ $qccpasstopresentroundlist_item->longno }}</td>
                                        <td class="center-align">{{ $qccpasstopresentroundlist_item->fay }}</td>
                                        <td class="center-align">{{ $qccpasstopresentroundlist_item->group_id }}</td>
                                        <td class="center-align">{{ $qccpasstopresentroundlist_item->act_name }}</td>

                                        @if($qccpasstopresentroundlist_item->act_cat == 'เทคนิค')
                                            <td class="center-align"><span class="chip blue lighten-5"><span class="blue-text">{{ $qccpasstopresentroundlist_item->act_cat }}</span></span></td>
                                        @elseif($qccpasstopresentroundlist_item->act_cat == 'สำนักงาน')
                                            <td class="center-align"><span class="chip amber lighten-5"><span class="amber-text">{{ $qccpasstopresentroundlist_item->act_cat }}</span></span></td>
                                        @else
                                            <td class="center-align"></td>
                                        @endif
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </li>
            </ul>
        </div><!-- CLOSE col s12 -->
    </div><!-- CLOSE popout row -->
@endif

@include('pages.page-qcc-intro')

@endsection

{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/scripts/ui-alerts.js')}}"></script>
{{-- ถ้าใช้ intro.js จะ active ได้ไม่เกิน 3 modal page --}}
{{-- <script src="{{asset('js/scripts/intro.js')}}"></script> --}}

<script>
    $(window).on('load', function () {

        $('.modal').modal({
            'onOpenEnd': initCarouselModal,
        });

        setTimeout(function () { $('.modal').modal('open'); }, 1800)


        $('.btn-next').on('click', function (e) {
            $('.intro-carousel').carousel('next');
        })

        $('.btn-prev').on('click', function (e) {
            $('.intro-carousel').carousel('prev');
        })

        // Inti carousel when modal pops up

        function initCarouselModal() {
            $('.carousel.carousel-slider').carousel({
                fullWidth: true,
                indicators: true,
                onCycleTo: function () {

                    // When carousel is at it's first step disable prev button

                    if ($('.carousel-item.active').index() == 1) {
                        $('.btn-prev').addClass('disabled');

                    }

                    // When carousel is at 2nd or 3rd step

                    else if ($('.carousel-item.active').index() > 1) {

                        // activate button

                        $('.btn-prev').removeClass('disabled');
                        $('.btn-next').removeClass('disabled');

                        // on 3rd step add and remove elements

                        if ($('.carousel-item.active').index() == 6) {
                            $('.btn-next').addClass('disabled');
                        }
                    }
                }
            })
        }

    });
</script>
@endsection
