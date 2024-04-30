<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link @if (Request::segment(2) == 'dashboard') @else collapsed @endif" href="{{ url('/backRoute') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if (Auth::user() && Auth::user()->role == 4)
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'users') @else collapsed @endif"
                    href="{{ url('/_admin/users') }}">
                    <i class="bi bi-person"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'roles') @else collapsed @endif"
                    href="{{ url('/_admin/roles') }}">
                    <i class="bi bi-tags"></i>
                    <span>Role Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'blocks') @else collapsed @endif"
                    href="{{ url('/_admin/blocks') }}">
                    <i class="bi bi-building"></i>
                    <span>Blocks</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'appointments') @else collapsed @endif"
                    href="{{ url('/_admin/appointments') }}">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'departments') @else collapsed @endif"
                    href="{{ url('/_admin/departments') }}">
                    <i class="bi bi-file-medical"></i>
                    <span>Departments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'ipd_patient') @else collapsed @endif"
                    href="{{ url('/_admin/ipd_patient') }}">
                    <i class="bi bi-person-wheelchair"></i>
                    <span>IPD-Patient In</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'bed_management') @else collapsed @endif"
                    href="{{ url('/_admin/bed_management') }}">
                    <i class="fas fa-bed"></i>
                    <span>Bed Management</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'ambulance') @else collapsed @endif"
                    href="{{ url('/_admin/ambulance') }}">
                    <i class="fas fa-pump-medical"></i>
                    <span>Ambulance</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'book_ambulance') @else collapsed @endif"
                    href="{{ url('/_admin/book_ambulance') }}">
                    <i class="fas fa-ambulance"></i>
                    <span>Book Ambulance</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'doctors') @else collapsed @endif"
                    href="{{ url('/_admin/doctors') }}">
                    <i class="bi bi-person-fill-check"></i>
                    <span>Doctors</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'nurses') @else collapsed @endif"
                    href="{{ url('/_admin/nurses') }}">
                    <i class="bi bi-person-standing-dress"></i>
                    <span>Nurses</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'pharmacists') @else collapsed @endif"
                    href="{{ url('/_admin/pharmacists') }}">
                    <i class="bi bi-prescription"></i>
                    <span>Pharmacists</span>
                </a>
            </li>
        @endif

        @if (Auth::user() && Auth::user()->role == 2)
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'appointments') @else collapsed @endif"
                    href="{{ url('/_doctor/appointments') }}">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'schedule') @else collapsed @endif"
                    href="{{ url('/_doctor/schedule') }}">
                    <i class="bi bi-calendar-date"></i>
                    <span>Schedule</span>
                </a>
            </li>
            {{-- Patient --}}
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'add_new_patient' || Request::segment(2)=='patient_list') @else collapsed @endif" data-bs-target="#patient-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bandaid"></i><span>Patients</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="patient-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{url('_doctor/add_new_patient')}}">
                            <i class="bi bi-circle-fill"></i><span>Add new patient</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('_doctor/patient_list')}}">
                            <i class="bi bi-circle-fill"></i><span>Patient List</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            {{-- End Patient --}}
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'diagnosis') @else collapsed @endif"
                    href="{{ url('/_doctor/diagnosis') }}">
                    <i class="bi bi-virus2"></i>
                    <span>Diagnosis</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'ipd_patient') @else collapsed @endif"
                    href="{{ url('/_doctor/ipd_patient') }}">
                    <i class="bi bi-person-wheelchair"></i>
                    <span>IPD-Patient In</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'prescription') @else collapsed @endif"
                    href="{{ url('/_doctor/prescription') }}">
                    <i class="bi bi-prescription2"></i>
                    <span>Prescription</span>
                </a>
            </li>
            {{-- Invoices --}}
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'invoices_list' || Request::segment(2)=='create_invoices') @else collapsed @endif" data-bs-target="#invoices-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-receipt-cutoff"></i><span>Invoices</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="invoices-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{url('_doctor/invoices_list')}}">
                            <i class="bi bi-circle-fill"></i><span>List of Invoices</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{url('_doctor/create_invoices')}}">
                            <i class="bi bi-circle-fill"></i><span>Create Invoices</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            {{-- End invoices --}}
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'profile') @else collapsed @endif"
                    href="{{ url('/_doctor/profile') }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li>
            
        @endif


        @if (Auth::user() && Auth::user()->role == 5)
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'profile') @else collapsed @endif"
                    href="{{ url('/_nurse/profile') }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li>
        @endif

        @if (Auth::user() && Auth::user()->role == 1)
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'appointments') @else collapsed @endif"
                    href="{{ url('/_user/appointments') }}">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Appointments</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'patient_profile') @else collapsed @endif"
                    href="{{ url('/_user/patient_profile') }}">
                    <i class="bi bi-person-square"></i>
                    <span>Patient Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'prescription') @else collapsed @endif"
                    href="{{ url('/_user/prescription') }}">
                    <i class="bi bi-prescription2"></i>
                    <span>Prescription</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'my_invoice') @else collapsed @endif"
                    href="{{ url('/_user/my_invoice') }}">
                    <i class="bi bi-receipt-cutoff"></i>
                    <span>My Invoices</span>
                </a>
            </li>
        @endif

        @if (Auth::user() && Auth::user()->role == 3)
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'appointments') @else collapsed @endif"
                    href="{{ url('/_pharmacist/medicines') }}">
                    <i class="bi bi-capsule-pill"></i>
                    <span>Medicines</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'profile') @else collapsed @endif"
                    href="{{ url('/_pharmacist/profile') }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Alerts</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Accordion</span>
                    </a>
                </li>
                <li>
                    <a href="components-badges.html">
                        <i class="bi bi-circle"></i><span>Badges</span>
                    </a>
                </li>
                <li>
                    <a href="components-breadcrumbs.html">
                        <i class="bi bi-circle"></i><span>Breadcrumbs</span>
                    </a>
                </li>
                <li>
                    <a href="components-buttons.html">
                        <i class="bi bi-circle"></i><span>Buttons</span>
                    </a>
                </li>
                <li>
                    <a href="components-cards.html">
                        <i class="bi bi-circle"></i><span>Cards</span>
                    </a>
                </li>
                <li>
                    <a href="components-carousel.html">
                        <i class="bi bi-circle"></i><span>Carousel</span>
                    </a>
                </li>
                <li>
                    <a href="components-list-group.html">
                        <i class="bi bi-circle"></i><span>List group</span>
                    </a>
                </li>
                <li>
                    <a href="components-modal.html">
                        <i class="bi bi-circle"></i><span>Modal</span>
                    </a>
                </li>
                <li>
                    <a href="components-tabs.html">
                        <i class="bi bi-circle"></i><span>Tabs</span>
                    </a>
                </li>
                <li>
                    <a href="components-pagination.html">
                        <i class="bi bi-circle"></i><span>Pagination</span>
                    </a>
                </li>
                <li>
                    <a href="components-progress.html">
                        <i class="bi bi-circle"></i><span>Progress</span>
                    </a>
                </li>
                <li>
                    <a href="components-spinners.html">
                        <i class="bi bi-circle"></i><span>Spinners</span>
                    </a>
                </li>
                <li>
                    <a href="components-tooltips.html">
                        <i class="bi bi-circle"></i><span>Tooltips</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="forms-elements.html">
                        <i class="bi bi-circle"></i><span>Form Elements</span>
                    </a>
                </li>
                <li>
                    <a href="forms-layouts.html">
                        <i class="bi bi-circle"></i><span>Form Layouts</span>
                    </a>
                </li>
                <li>
                    <a href="forms-editors.html">
                        <i class="bi bi-circle"></i><span>Form Editors</span>
                    </a>
                </li>
                <li>
                    <a href="forms-validation.html">
                        <i class="bi bi-circle"></i><span>Form Validation</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="tables-general.html">
                        <i class="bi bi-circle"></i><span>General Tables</span>
                    </a>
                </li>
                <li>
                    <a href="tables-data.html">
                        <i class="bi bi-circle"></i><span>Data Tables</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="charts-chartjs.html">
                        <i class="bi bi-circle"></i><span>Chart.js</span>
                    </a>
                </li>
                <li>
                    <a href="charts-apexcharts.html">
                        <i class="bi bi-circle"></i><span>ApexCharts</span>
                    </a>
                </li>
                <li>
                    <a href="charts-echarts.html">
                        <i class="bi bi-circle"></i><span>ECharts</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="icons-bootstrap.html">
                        <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
                    </a>
                </li>
                <li>
                    <a href="icons-remix.html">
                        <i class="bi bi-circle"></i><span>Remix Icons</span>
                    </a>
                </li>
                <li>
                    <a href="icons-boxicons.html">
                        <i class="bi bi-circle"></i><span>Boxicons</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Icons Nav -->

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-register.html">
                <i class="bi bi-card-list"></i>
                <span>Register</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-login.html">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
        </li><!-- End Login Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-error-404.html">
                <i class="bi bi-dash-circle"></i>
                <span>Error 404</span>
            </a>
        </li><!-- End Error 404 Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
