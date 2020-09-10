<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        body {
            font-size: 14px;
        }
        h4{
            font-size: 15px;
        }
        table{
            width: 100%;
        }
        th{
            text-align: left;
        }
        .payment_table table {
            border-collapse: collapse;
            width: 100%;
        }
        .payment_table th,.payment_table td {
            border: 0.5px solid black;
            text-align: left;
            padding-left: 5px;
        }
        .padding-10{
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
<div class="">
    <section style="border-bottom: 1px solid black; padding-bottom: 10px;margin-bottom: 10px;font-family: 'bangla', sans-serif;">
        <div style="text-align: center;padding-bottom: 10px;display: inline-block;">
            <img style="width: 100px;height: 100px" src="{{ asset('/admin-panel') }}{{ (!empty($logo)) ? '/'.$logo : '/site_uploads/thumb.jpg' }}" class="rounded bg-white" alt="...">
        </div>
        <div class="">
            {!! (!empty($header_content)) ? $header_content : '<h3 class="text-danger m-0">বাংলাদেশ এক্স-ক্যাডেটস এসোসিয়েশন (বেকা)</h3>'  !!}
        </div>
    </section>
    <section class="">
        <div class="container-fluid" style="border-bottom: 1px solid black;padding-bottom: 10px;">
            <div>

                <table>
                    <tr>
                        <td>
                            <div>
                                <h4>BECA Details</h4>
                            </div>
                            <br>
                            <div>
                                @if ($account_info->status != 'approve')
                                    <span style="color: red"> Your account is not approve yet. please wait or contact with Authorised</span>
                                @else
                                    <div>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>BECA Reg. Number</td>
                                                <td>: {!! ($beca_details->beca_reg_id) ? $beca_details->beca_reg_id : '<span>Not Created</span>' !!}</td>
                                            </tr>

{{--                                            <tr>--}}
{{--                                                <td>Registration Unite</td>--}}
{{--                                                <td>: {!! ($registration_unite) ? $registration_unite: '_ _ _ _' !!}</td>--}}
{{--                                            </tr>--}}
                                            <tr>
                                                <td>Member Since</td>
                                                <td>: {{ date("m-d-Y", strtotime($account_info->created_at)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Current Unite</td>
                                                <td>: {!! ($current_unite) ? $current_unite : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Member Type</td>
                                                <td>: {!! ($member_type) ? $member_type : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>NEC Member</td>
                                                <td>: {{ ($beca_details->nec_member == 1)? 'Yes':'No' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Position</td>
                                                <td>: {!! ($beca_details->position) ? $beca_details->position : '_ _ _ _' !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <img style="position:absolute;left: 0;border:1px solid black;width: 150px;" class="" src="{{ asset('/user_panel/'.$personal_info->profile_image) }}" alt="">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div>
                <div>
                    <h4 class="padding-10">Personal Information</h4>
                </div>
                <div>
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <div>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td>: {!! ($personal_info->name) ? $personal_info->name : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Spouse Name</td>
                                                <td>: {!! ($personal_info->spouse_name) ? $personal_info->spouse_name : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Father Name</td>
                                                <td>: {!! ($personal_info->father_name) ? $personal_info->father_name : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Mother Name</td>
                                                <td>: {!! ($personal_info->mother_name) ? $personal_info->mother_name : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td>: {!! ($personal_info->gender) ? $personal_info->gender : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Blood Group</td>
                                                <td>: {!! ($personal_info->blood) ? $personal_info->blood : '_ _ _ _' !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-div">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>Height</td>
                                                <td>: {!! ($personal_info->height) ? $personal_info->height : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Religion</td>
                                                <td>: {!! ($personal_info->religion) ? $personal_info->religion : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Birth</td>
                                                <td>: {!! ($personal_info->birth_date) ? $personal_info->birth_date : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>NID/Passport</td>
                                                <td>: {!! ($personal_info->nid_pass) ? $personal_info->nid_pass : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Driving Licence</td>
                                                <td>: {!! ($personal_info->driving_lic) ? $personal_info->driving_lic : '_ _ _ _' !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>


                    </div>

                </div>

            </div>
        </div>




        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div>
                <div>
                    <h4 class="padding-10">Address Details</h4>
                </div>
                <div>
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <div>
                                        <div>
                                            <h5>Present Address</h5>
                                        </div>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>House No</td>
                                                <td>: {!! ($address_details->present_house) ? $address_details->present_house : '_ _ _ _' !!}</td>
                                            </tr>

                                            <tr>
                                                <td>Village/Area</td>
                                                <td>: {!! ($address_details->present_village) ? $address_details->present_village : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Upazila/Thana</td>
                                                <td>: {!! ($address_details->present_upazila) ? $address_details->present_upazila : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>District</td>
                                                <td>: {!! ($address_details->present_district) ? $address_details->present_district : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>division</td>
                                                <td>: {!! ($address_details->present_division) ? $address_details->present_division : '_ _ _ _' !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="light-color">
                                            <h5>Permanent Address</h5>
                                        </div>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>House No</td>
                                                <td>: {!! ($address_details->permanent_house) ? $address_details->permanent_house : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Village/Area</td>
                                                <td>: {!! ($address_details->permanent_village) ? $address_details->permanent_village : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Upazila/Thana</td>
                                                <td>: {!! ($address_details->permanent_upazila) ? $address_details->permanent_upazila : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>District</td>
                                                <td>: {!! ($address_details->permanent_district) ? $address_details->permanent_district : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Division</td>
                                                <td>: {!! ($address_details->permanent_division) ? $address_details->permanent_division : '_ _ _ _' !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>


                    </div>
                </div>

            </div>
        </div>



        <div class="container-fluid">

            <!-- DataTales Example -->
            <div>
                <div>
                    <h4 class="padding-10">Cadate Details</h4>
                </div>
                <div>
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <div>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>Institute Name</td>
                                                <td>: {!! ($cadet_details->institute_name) ? $cadet_details->institute_name : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Institute Address</td>
                                                <td>: {!! ($cadet_details->institute_address) ? $cadet_details->institute_address : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Cadet ID</td>
                                                <td>: {!! ($cadet_details->cadet_id) ? $cadet_details->cadet_id : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Regiment</td>
                                                <td>: {!! ($cadet_details->regiment) ? $cadet_details->regiment : '_ _ _ _' !!}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-div">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>Cadet Rank</td>
                                                <td>: {!! ($cadet_details->cadet_rank) ? $cadet_details->cadet_rank : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Cadet Wing</td>
                                                <td>: {!! ($cadet_details->cadet_wing) ? $cadet_details->cadet_wing : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Cadetship Year</td>
                                                <td>: {!! ($cadet_details->cadet_ship_year) ? $cadet_details->cadet_ship_year : '_ _ _ _' !!}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div>
                <div>
                    <h4>Education & Profession Details</h4>

                </div>
                <div>
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <div>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>SSC Batch</td>
                                                <td>: {!! ($edu_pro_details->ssc_batch) ? $edu_pro_details->ssc_batch : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Higher Degree</td>
                                                <td>: {!! ($edu_pro_details->edu_qualification) ? $edu_pro_details->edu_qualification : '_ _ _ _' !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-div">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>Profession</td>
                                                <td>: {!! ($edu_pro_details->profession) ? $edu_pro_details->profession : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Work Address</td>
                                                <td>: {!! ($edu_pro_details->work_address) ? $edu_pro_details->work_address : '_ _ _ _' !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div>
                <div>
                    <h4>Contact Details</h4>

                </div>
                <div>
                    <div>
                        <table>
                            <tr>
                                <td>
                                    <div>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>phone</td>
                                                <td>: {!! ($account_info->phone) ? $account_info->phone : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>: {!! ($contact_details->email) ? $contact_details->email : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Secondary Number</td>
                                                <td>: {!! ($contact_details->secondary_number) ? $contact_details->secondary_number : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <td>Emergency Number</td>
                                                <td>: {!! ($contact_details->emergency_number) ? $contact_details->emergency_number : '_ _ _ _' !!}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-div">
                                        <table>
                                            <tbody>
                                            <tr>
                                                <th>Facebook</th>
                                                <td>: {!! ($contact_details->facebook) ? $contact_details->facebook : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Twitter</th>
                                                <td>: {!! ($contact_details->twitter) ? $contact_details->twitter : '_ _ _ _' !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Skype</th>
                                                <td>: {!! ($contact_details->skype) ? $contact_details->skype : '_ _ _ _' !!}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div>
                <div>
                    <h4>Submitted Documents</h4>
                </div>
                <div>
                    <div>
                        <div>
                            <table>
                                <tbody>
                                <tr>
                                    <td>NID/Passport</td>
                                    <td>: {!! ($verification_docs->user_nid_pass_doc) ? 'Submitted' : 'Not Submitted' !!}</td>
                                </tr>
                                <tr>
                                    <td>Cadet Certificate</td>
                                    <td>: {!! ($verification_docs->user_cadet_certificate_doc) ? 'Submitted' : 'Not Submitted' !!}</td>
                                </tr>
                                <tr>
                                    <td>Beca Documents</td>
                                    <td>: {!! ($verification_docs->user_beca_doc) ? 'Submitted' : 'Not Submitted' !!}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div>
                <div>
                    <h4>Payment lists</h4>
                </div>
                <div>
                    <div class="payment_table">
                        <table>
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Payment Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($payment_info as $payment)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $payment->payment_amount }}</td>
                                    <td>{{ $payment->method }}</td>
                                    <td>{{ $payment->payment_date }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section style="margin-top: 100px;border-top:1px solid black;">
        <div  style="float:left;width:400px;text-align: left;display: inline-block">
            <p style="font-size: 12px"> <strong>Powered</strong> by <strong><a href="https://nirviq.com/" target='_blank'>NIRVIQ IT LIMITED</a></strong>(nirviq.com)</p>
        </div>
        <div style="float:right;width:170px;text-align: right;margin-top:10px;display: inline-block">
                <a href="https://nirviq.com/" target="_blank"><img style="width: 20px;height: 20px;" src="{{ asset('/') }}admin-panel/img/nirviq.png" class="nirviq-logo ml-2" alt=""></a>
        </div>
    </section>
</div>

</body>

</html>
