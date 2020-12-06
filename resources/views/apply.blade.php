@extends('layouts.app')

@section('content')
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 1200px;
            margin: auto;
            text-align: center;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover, a:hover {
            opacity: 0.7;
        }

        img{
            width:200px;
            height:200px;
        }
        hr.new4 {
            border: 1px solid grey;
        }
         .checked {
             color: orange;
         }
    </style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Application</div>

                <!-- Add icon library -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


                    <h2><?php echo "Company: ".$company;?></h2>
                    <p><?php echo "Title: ".$title;?></p>
                    <p><?php echo "Salary: ".$salary;?></p>
                    <p><?php echo "Location: ".$location;?></p>
                    <p><?php echo "Job description: ".$description;?></p>
                    <p><?php echo "Qualifications: ".$qualifications;?></p>


                <div>
                    <form action="submitApply"  method="post" onsubmit="return ValidateForm(this);">
                        {{csrf_field()}}
                        <script type="text/javascript">
                            function ValidateForm(frm) {
                                if (frm.First_Name.value == "") { alert('First name is required.'); frm.First_Name.focus(); return false; }
                                if (frm.Last_Name.value == "") { alert('Last name is required.'); frm.Last_Name.focus(); return false; }
                                if (frm.Email_Address.value == "") { alert('Email address is required.'); frm.Email_Address.focus(); return false; }
                                if (frm.Email_Address.value.indexOf("@") < 1 || frm.Email_Address.value.indexOf(".") < 1) { alert('Please enter a valid email address.'); frm.Email_Address.focus(); return false; }
                                if (frm.Position.value == "") { alert('Position is required.'); frm.Position.focus(); return false; }
                                if (frm.Phone.value == "") { alert('Phone is required.'); frm.Phone.focus(); return false; }
                                return true; }
                        </script>
                        <table border="0" cellpadding="5" cellspacing="0">
                            <tr> <td style="width: 50%">
                                    <label for="First_Name"><b>First name *</b></label><br />
                                    <input name="First_Name" type="text" maxlength="50" style="width:100%;max-width: 260px" />
                                </td> <td style="width: 50%">
                                    <label for="Last_Name"><b>Last name *</b></label><br />
                                    <input name="Last_Name" type="text" maxlength="50" style="width:100%;max-width: 260px" />
                                </td> </tr> <tr> <td colspan="2">
                                    <label for="Email_Address"><b>Email *</b></label><br />
                                    <input name="Email_Address" type="text" maxlength="100" style="width:100%;max-width: 535px" />
                                </td> </tr> <tr> <td colspan="2">
                                    <label for="Position"><b>Position you are applying for *</b></label><br />
                                    <input name="Position" type="text" maxlength="100" style="width:100%;max-width: 535px" />
                                </td> </tr> <tr> <td>
                                    <label for="Salary"><b>Salary requirements</b></label><br /> <input name="Salary" type="text" maxlength="50" style="width:100%;max-width: 260px" /> </td> <td>
                                    <label for="StartDate"><b>When can you start?</b></label><br />
                                    <input name="StartDate" type="text" maxlength="50" style="width:100%;max-width: 260px" />
                                </td> </tr> <tr> <td>
                                    <label for="Phone"><b>Phone *</b></label><br />
                                    <input name="Phone" type="text" maxlength="50" style="width:100%;max-width: 260px" />
                                </td> <td>
                                    <label for="Fax"><b>Fax</b></label><br />
                                    <input name="Fax" type="text" maxlength="50" style="width:100%;max-width: 260px" />
                                </td> </tr> <tr> <td colspan="2">
                                    <label for="Organization"><b>Last company you worked for</b></label><br />
                                    <input name="Organization" type="text" maxlength="100" style="width:100%;max-width: 535px" />
                                </td> </tr> <tr> <td colspan="2">
                                    <label for="Reference"><b>Reference</b></label><br />
                                    <textarea name="Reference" rows="7" cols="40" style="width:100%;max-width: 535px"></textarea>
                                    <div class="form-group">
                                        <div >
                                            <button type="submit" class="btn btn-info">
                                                <i class="fa fa-btn fa-star"></i> Apply
                                            </button>
                                        </div>
                                    </div>
                        </table>
                    </form>


                </div>


            </div>
        </div>
    </div>
</div>
@endsection
