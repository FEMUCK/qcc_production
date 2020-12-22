<!-- Intro -->
<div id="intro">
    <div class="row">
        <div class="col s12">

            <div id="img-modal" class="modal white">
                <div class="modal-content">
                    <div class="bg-img-div"></div>
                    <p class="modal-header right modal-close">
                        Skip Intro <span class="right"><i class="material-icons right-align">clear</i></span>
                    </p>
                    <div class="carousel carousel-slider center intro-carousel">
                        <div class="carousel-fixed-item center middle-indicator">
                            <div class="left">
                                <button class="movePrevCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-prev">
                                    <i class="material-icons">navigate_before</i> <span class="hide-on-small-only">Prev</span>
                                </button>
                            </div>

                            <div class="right">
                                <button class=" moveNextCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-next">
                                    <span class="hide-on-small-only">Next</span> <i class="material-icons">navigate_next</i>
                                </button>
                            </div>
                        </div>

                        <div class="carousel-item slide-1">
                            <h5 class="intro-step-title mt-7 center animated fadeInUp">การลงทะเบียนผลงานกิจกรรมพัฒนาคุณภาพ กฟผ.</h5>
                            <br>
                            <img src="{{asset('images/gallery/create_qcc.gif')}}" alt="" class="responsive-img animated fadeInUp slide-1-img">
                            <p class="intro-step-text mt-5 animated fadeInUp">
                                1.เลือกเมนู QCC Data Table จากนั้นกดปุ่ม
                                <button type="button" class="btn gradient-45deg-red-pink waves-effect waves-light border-round z-depth-4 btn-small">Create
                                    <i class="mdi mdi-plus left" style="margin-right: 5px;"></i>
                                </button>
                            </p>
                        </div>

                        <div class="carousel-item slide-2">
                            <h5 class="intro-step-title mt-7 center animated fadeInUp">การลงทะเบียนผลงานกิจกรรมพัฒนาคุณภาพ กฟผ.</h5>
                            <br>
                            <img src="{{asset('images/gallery/save_qcc.gif')}}" alt="" class="responsive-img animated fadeInUp slide-1-img">
                            <p class="intro-step-text mt-5 animated fadeInUp">
                                2.กรอกข้อมูลให้ครบถ้วนแล้วกด
                                <button class="waves-effect waves dark btn btn-primary next-step btn-small" type="button">Next
                                    <i class="material-icons right">arrow_forward</i>
                                </button>
                                เพื่อไปกรอกข้อมูล step ถัดไป
                                <br>
                                หลังจากกรอกข้อมูลครบทุกส่วนแล้วกด <button class="waves-effect waves-dark btn btn-primary btn-small" type="submit">Submit</button> เพื่อบันทึกข้อมูล
                            </p>
                        </div>

                        <div class="carousel-item slide-3">
                            <h5 class="intro-step-title mt-7 center animated fadeInUp">การเข้าดูข้อมูลผลงานกิจกรรมพัฒนาคุณภาพ กฟผ.</h5>
                            <br>
                            <img src="{{asset('images/gallery/view_qcc.gif')}}" alt="" class="responsive-img animated fadeInUp slide-2-img">
                            <p class="intro-step-text mt-5 animated fadeInUp">
                                เลือกเมนู QCC Data Table จากนั้นกดปุ่ม
                                <button class="gradient-45deg-light-blue-cyan btn waves-effect waves-light btn-floating btn-small"><i class="mdi mdi-eye"></i></button>
                                เพื่อดูข้อมูลผลงานฯ ที่ลงทะเบียนไว้
                            </p>
                        </div>

                        <div class="carousel-item slide-4">
                            <h5 class="intro-step-title mt-7 center animated fadeInUp">การ print ข้อมูลผลงานกิจกรรมพัฒนาคุณภาพ กฟผ.</h5>
                            <br>
                            <img src="{{asset('images/gallery/print_qcc.gif')}}" alt="" class="responsive-img animated fadeInUp slide-2-img">
                            <p class="intro-step-text mt-5 animated fadeInUp">
                                หลังจากเลือกเมนู QCC Data Table และกดปุ่ม <button class="gradient-45deg-light-blue-cyan btn waves-effect waves-light btn-floating btn-small"><i class="mdi mdi-eye"></i></button> แล้ว
                                <br>
                                ทางด้านขวาของ screen สามารถ print ข้อมูลออกมาเป็น form ได้โดยกดปุ่ม
                                <button class="btn btn-light-indigo waves-effect waves-light invoice-print btn-small">
                                    <i class="mdi mdi-printer" style="margin-top: -7px;"></i>
                                    <span>Print</span>
                                </button>
                            </p>
                        </div>

                        <div class="carousel-item slide-5">
                            <h5 class="intro-step-title mt-7 center animated fadeInUp">การแก้ไขข้อมูลผลงานกิจกรรมพัฒนาคุณภาพ กฟผ.</h5>
                            <br>
                            <img src="{{asset('images/gallery/edit_qcc.gif')}}" alt="" class="responsive-img animated fadeInUp slide-2-img">
                            <p class="intro-step-text mt-5 animated fadeInUp">
                                เลือกเมนู QCC Data Table จากนั้นกดปุ่ม
                                <button class="gradient-45deg-amber-amber btn waves-effect waves-light btn-floating btn-small"><i class="mdi mdi-pencil"></i></button>
                                เพื่อแก้ไขข้อมูลผลงานฯ ที่ลงทะเบียนไว้
                            </p>
                            {{-- <br>
                            <img src="{{asset('images/gallery/edit_from_view_qcc.gif')}}" alt="" class="responsive-img animated fadeInUp slide-2-img">
                            <p class="intro-step-text mt-5 animated fadeInUp">
                                ทั้งนี้สามารถแก้ไขข้อมูลจากหน้า View ได้เช่นกัน โดยกดปุ่ม
                                <button class="btn btn-light-amber waves-effect waves-light btn-small">
                                    <i class="mdi mdi-file-edit" style="margin-top: -7px;"></i>
                                    <span>Edit</span>
                                </button>
                            </p> --}}
                        </div>

                        <div class="carousel-item slide-6">
                            <h5 class="intro-step-title mt-7 center">การลบข้อมูลผลงานกิจกรรมพัฒนาคุณภาพ กฟผ.</h5>
                            <br>
                            <img src="{{asset('images/gallery/delete_qcc.gif')}}" alt="" class="responsive-img animated fadeInUp slide-2-img">
                            <p class="intro-step-text mt-5 animated fadeInUp">
                                เลือกเมนู QCC Data Table จากนั้นกดปุ่ม
                                <button class="gradient-45deg-red-pink btn waves-effect waves-light btn-floating btn-small"><i class="mdi mdi-trash-can"></i></button>
                                เพื่อลบข้อมูลผลงานฯ ที่ลงทะเบียนไว้
                            </p>


                            <div class="row">
                                <div class="row">
                                    <div class="col s12 center">
                                        <button class="get-started btn waves-effect waves-light gradient-45deg-purple-deep-orange mt-3 modal-close">Get Started</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Intro -->
