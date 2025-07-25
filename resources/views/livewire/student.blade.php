
<div class="col-lg-7 formify-booking-column-main formify-mg-top-30">
    <form wire:submit.prevent="save" id="multiStepForm" enctype="multipart/form-data"
        class="formify-forms formify-forms__booking formify-form-shadow" action="#">
        @csrf
        <div class="formify-form__bookingv2--box">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif
            <!-- Welcome Banner -->
            <div class="formify-form__form-box formify-form__form-box--v5">
                <div class="list-group formify-form__nav formify-form__booking-nav" id="list-tab" role="tablist">
                    <a class="list-group-item active" data-bs-toggle="list" href="#step1" role="tab">
                        <span class="fstp-count"><span>1</span> <i class="fas fa-check"></i></span>
                        <span class="fstp-text">Personal Details</span>
                    </a>
                    <a class="list-group-item" data-bs-toggle="list" href="#step2" role="tab">
                        <span class="fstp-count"><span>2</span> <i class="fas fa-check"></i></span>
                        <span class="fstp-text">Education</span>
                    </a>
                    <a class="list-group-item" data-bs-toggle="list" href="#step3" role="tab">
                        <span class="fstp-count"><span>3</span> <i class="fas fa-check"></i></span>
                        <span class="fstp-text">Select Courses</span>
                    </a>
                </div>

                <div class="tab-content">
                    <!-- Step 1: Personal Information -->
                    <div class="tab-pane fade show active" id="step1">
                        <div class="formify-forms__booking-form formify-mg-top-30">
                            <div class="formify-forms__booking-form">
                                <div class="formify-forms__booking-form--single">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Name (as written on CNIC/B Form/Marksheet)
                                                *</label>
                                            <div class="formify-forms__input">
                                                <input type="text" wire:model="full_name" placeholder="Enter name"
                                                    required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Father's Name *</label>
                                            <div class="formify-forms__input">
                                                <input type="text" wire:model="father_name"
                                                    placeholder="Enter Father Name" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="formify-forms__booking-form--single formify-mg-top-20">
                                        <h4 class="formify-forms__booking-title">Gender *</h4>
                                        <div class="form-group form-group__flex">
                                            <select class="form-select" wire:model="gender" required="required">
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>CNIC Number (without dashes) *</label>
                                            <div class="formify-forms__input">
                                                <input type="text" wire:model="cnic_number" placeholder="Your CNIC"
                                                    required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Email *</label>
                                            <div class="formify-forms__input">
                                                <input  type="email" wire:model="email" placeholder="Your Email"
                                                    required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Contact Number (WhatsApp) *</label>
                                            <div class="formify-forms__input">
                                                <input type="text" wire:model="contact_number"
                                                    placeholder="Your Contact" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Date of Birth (as written on CNIC) *</label>
                                            <div class="formify-forms__input">
                                                <input type="date" wire:model="date_of_birth" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Profile Picture (passport size, max file size
                                                1 mb) *</label>
                                            <div class="formify-forms__input">
                                                <input type="file" wire:model="profile_picture" required="required"
                                                    accept="image/*" style="padding-top: 13px; font-size: 12px;">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group formify-mg-top-20">
                                        <div class="formify-forms__button formify-forms__button-between">
                                            <button class="formify-btn next-step">
                                                Next
                                                <svg width="16" height="14" viewBox="0 0 16 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.125 7H14.875M14.875 7L9.25 1.375M14.875 7L9.25 12.625"
                                                        stroke="white" stroke-width="1.4" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Education -->
                    <div class="tab-pane fade" id="step2">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Upload Intermediate/Equivalent (HSC-II) Marksheet or
                                    Pakka *</label>
                                <div class="formify-forms__input">
                                    <input type="file" wire:model="intermediate_marksheet" required="required"
                                        accept="image/*" style="padding-top: 13px; font-size: 12px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Upload Your Domicile or Form C (maximum file size is 1
                                    mb) *</label>
                                <div class="formify-forms__input">
                                    <input type="file" wire:model="domicile_form_c" required="required"
                                        accept="image/*" style="padding-top: 13px; font-size: 12px;">
                                </div>
                            </div>
                        </div>
                        <div class="formify-forms__booking-form--single formify-mg-top-20">
                            <h4 class="formify-forms__booking-title">Domicile District *</h4>
                            <div class="form-group form-group__flex">
                                <select wire:model="domicile_district" class="form-select" required="required">
                                    <option value="">Select District</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                    <option value="Jamshoro">Jamshoro</option>
                                    <option value="Badin">Badin</option>
                                    <option value="Dadu">Dadu</option>
                                    <option value="Matiari">Matiari</option>
                                    <option value="Mirpur Khas">Mirpur Khas</option>
                                    <option value="Sujawal">Sujawal</option>
                                    <option value="Tando Allahyar">Tando Allahyar</option>
                                    <option value="Tando Mohammad Khan">Tando Mohammad Khan
                                    </option>
                                    <option value="Thatta">Thatta</option>
                                    <option value="Umerkot">Umerkot</option>
                                </select>
                            </div>
                        </div>
                        <div class="formify-forms__booking-form--single formify-mg-top-20">
                            <h4 class="formify-forms__booking-title">Are you currently
                                admitted/enrolled/studying in university? *</h4>
                            <div class="form-group form-group__flex">
                                <select class="form-select" wire:model="is_enrolled" required="required">
                                    <option value="">Select Option</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>If yes, write the name of the university/institute in
                                    which you are currently studying?</label>
                                <div class="formify-forms__input">
                                    <input type="text" wire:model="university_name" placeholder="University Name">
                                </div>
                            </div>
                        </div>
                        <div class="formify-forms__booking-form--single formify-mg-top-20">
                            <h4 class="formify-forms__booking-title">Your preferred center for
                                study? *</h4>
                            <div class="form-group form-group__flex">
                                <select class="form-select" wire:model="preferred_study_center" required="required">
                                    <option value="">Select Center</option>
                                    <option value="MUET Jamshoro">MUET, Jamshoro</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                    <option value="Mirpurkhas">Mirpurkhas</option>
                                    <option value="Dadu">Dadu</option>
                                    <option value="Thatta">Thatta</option>
                                    <option value="Umerkot">Umerkot</option>
                                </select>
                            </div>
                        </div>
                        <div class="formify-forms__booking-form--single formify-mg-top-20">
                            <h4 class="formify-forms__booking-title">Your preferred time slot *
                            </h4>
                            <div class="form-group form-group__flex">
                                <select class="form-select" wire:model="preferred_time_slot" required="required">
                                    <option value="">Select Time Slot</option>
                                    <option value="9 AM to 12 PM">9 AM to 12 PM (Morning)
                                    </option>
                                    <option value="12 PM to 3 PM">12 PM to 3 PM (Afternoon)
                                    </option>
                                    <option value="3 PM to 6 PM">3 PM to 6 PM (Evening)
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group formify-mg-top-20">
                            <div class="formify-forms__button gap15">
                                <button class="formify-btn prev-step">
                                    <svg width="16" height="11" viewBox="0 0 16 11" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M0.21792 4.977L4.97925 0.242992C5.26975 -0.0458411 5.74088 -0.0458411 6.03138 0.242992C6.32194 0.531885 6.32194 1.0002 6.03138 1.28909L2.54008 4.76036H15.256C15.6669 4.76036 16 5.09156 16 5.50004C16 5.90847 15.6669 6.23973 15.256 6.23973H2.54008L6.03127 9.711C6.32183 9.99989 6.32183 10.4682 6.03127 10.7571C5.88604 10.9014 5.69559 10.9737 5.5052 10.9737C5.3148 10.9737 5.12441 10.9014 4.97913 10.7571L0.21792 6.02309C-0.0726395 5.7342 -0.0726395 5.26589 0.21792 4.977Z">
                                    </svg>
                                    Back
                                </button>
                                <button class="formify-btn next-step">
                                    Next
                                    <svg width="20" height="15" viewBox="0 0 20 15" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.7276 6.84612L13.7759 0.928618C13.4128 0.567576 12.8239 0.567576 12.4608 0.928618C12.0976 1.28973 12.0976 1.87512 12.4608 2.23624L16.8249 6.57532H0.929947C0.416393 6.57532 0 6.98933 0 7.49993C0 8.01047 0.416393 8.42454 0.929947 8.42454H16.8249L12.4609 12.7636C12.0977 13.1247 12.0977 13.7101 12.4609 14.0712C12.6424 14.2517 12.8805 14.342 13.1185 14.342C13.3565 14.342 13.5945 14.2517 13.7761 14.0712L19.7276 8.15374C20.0908 7.79263 20.0908 7.20724 19.7276 6.84612Z">
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Select Courses -->
                    <div class="tab-pane fade" id="step3">
                        <div class="formify-forms__booking-form formify-mg-top-30">
                            <div class="formify-forms__booking-form">
                                <div class="formify-forms__booking-form--single">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="formify-forms__booking-form--single formify-mg-top-20">
                                                <h4 class="formify-forms__booking-title">1st
                                                    Choice *</h4>
                                                <div class="form-group">
                                                    <label for="course_choice_1">Select Course
                                                        (Choice 1)</label>
                                                    <select wire:model="course_choice_1" class="form-control">
                                                        <option value="">-- Select a
                                                            Course --</option>
                                                        @foreach ($courseList as $course)
                                                            <option value="{{ $course }}">
                                                                {{ $course }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('course_choice_1')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formify-forms__booking-form--single formify-mg-top-20">
                                                <h4 class="formify-forms__booking-title">2nd
                                                    Choice *</h4>
                                                <div class="form-group form-group__flex">
                                                    <select class="form-select" wire:model="course_choice_2"
                                                        required="required">
                                                        <option value="">Select Course
                                                        </option>
                                                        <option value="Certified Java Developer">
                                                            Certified Java Developer</option>
                                                        <option value="Certified Python Developer">
                                                            Certified Python Developer</option>
                                                        <option value="Certified Database Developer">
                                                            Certified Database Developer
                                                        </option>
                                                        <option value="Certified E-commerce Professional">
                                                            Certified E-commerce Professional
                                                        </option>
                                                        <option value="Certified Digital Marketing Professional">
                                                            Certified Digital Marketing
                                                            Professional</option>
                                                        <option value="Certified Web Developer">
                                                            Certified Web Developer</option>
                                                        <option value="Certified Mobile Application Developer">
                                                            Certified Mobile Application
                                                            Developer</option>
                                                        <option value="Certified Data Scientist">
                                                            Certified Data Scientist</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formify-forms__booking-form--single formify-mg-top-20">
                                                <h4 class="formify-forms__booking-title">3rd
                                                    Choice *</h4>
                                                <div class="form-group form-group__flex">
                                                    <select class="form-select" wire:model="course_choice_3"
                                                        required="required">
                                                        <option value="">Select Course
                                                        </option>
                                                        <option value="Certified Java Developer">
                                                            Certified Java Developer</option>
                                                        <option value="Certified Python Developer">
                                                            Certified Python Developer</option>
                                                        <option value="Certified Database Developer">
                                                            Certified Database Developer
                                                        </option>
                                                        <option value="Certified E-commerce Professional">
                                                            Certified E-commerce Professional
                                                        </option>
                                                        <option value="Certified Digital Marketing Professional">
                                                            Certified Digital Marketing
                                                            Professional</option>
                                                        <option value="Certified Web Developer">
                                                            Certified Web Developer</option>
                                                        <option value="Certified Mobile Application Developer">
                                                            Certified Mobile Application
                                                            Developer</option>
                                                        <option value="Certified Data Scientist">
                                                            Certified Data Scientist</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="formify-forms__booking-form--single formify-mg-top-20">
                                                <h4 class="formify-forms__booking-title">4th
                                                    Choice *</h4>
                                                <div class="form-group form-group__flex">
                                                    <select class="form-select" wire:model="course_choice_4"
                                                        required="required">
                                                        <option value="">Select Course
                                                        </option>
                                                        <option value="Certified Java Developer">
                                                            Certified Java Developer</option>
                                                        <option value="Certified Python Developer">
                                                            Certified Python Developer</option>
                                                        <option value="Certified Database Developer">
                                                            Certified Database Developer
                                                        </option>
                                                        <option value="Certified E-commerce Professional">
                                                            Certified E-commerce Professional
                                                        </option>
                                                        <option value="Certified Digital Marketing Professional">
                                                            Certified Digital Marketing
                                                            Professional</option>
                                                        <option value="Certified Web Developer">
                                                            Certified Web Developer</option>
                                                        <option value="Certified Mobile Application Developer">
                                                            Certified Mobile Application
                                                            Developer</option>
                                                        <option value="Certified Data Scientist">
                                                            Certified Data Scientist</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Form Group -->
                                <div class="form-group formify-mg-top-20">
                                    <div class="formify-forms__button gap15">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
    </form>
</div>
