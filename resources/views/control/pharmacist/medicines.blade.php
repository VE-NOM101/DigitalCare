@extends('control.layout._app')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Medicines Manager</h5>

                <!-- Bordered Tabs Justified -->
                <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home"
                            aria-selected="true">Medicine Categories</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false">Medicine Brands</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="medicine-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-medicine" type="button" role="tab"
                            aria-controls="medicine" aria-selected="false">Medicines</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="purchase-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-purchase" type="button" role="tab"
                            aria-controls="purchase" aria-selected="false">Purchase Medicines</button>
                    </li>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab"
                            data-bs-target="#bordered-justified-contact" type="button" role="tab"
                            aria-controls="contact" aria-selected="false">Contact</button>
                    </li>
                </ul>
                <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                    <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel"
                        aria-labelledby="home-tab">
                        Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est
                        unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga
                        sequi sed ea saepe at unde.
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel"
                        aria-labelledby="profile-tab">
                        Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio
                        omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate
                        nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-medicine" role="tabpanel"
                        aria-labelledby="medicine-tab">
                       
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-purchase" role="tabpanel"
                        aria-labelledby="purchase-tab">
                       
                    </div>
                    <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel"
                        aria-labelledby="contact-tab">
                        Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium
                        quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam.
                        Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                    </div>
                </div><!-- End Bordered Tabs Justified -->

            </div>
        </div>
    </div>
@endsection
