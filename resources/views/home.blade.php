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
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                     You are logged in!

                </div>

                <!-- Add icon library -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                <div class="card">
                    <img id ="profileImg "src="{{asset('/default.jpg')}} ">
                    <h2><?php echo "".$name;?></h2>
                    <p><?php echo "Email: ".$username;?></p>
                    <p><?php echo "Gender: ".$gender;?></p>
                    <p><?php echo "Age: ".$age;?></p>
                    <p><?php echo "Education: ".$education;?></p>
                    <p><?php echo "Most recent employer: ".$employer;?></p>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <p><button>Contact</button></p>
                </div>
                <div class="card">
                    <h1>Employment History</h1>
                    @if($employmentList!=null)
                    @foreach($employmentList as $employerData)
                        <h4><?php echo $employerData->get_company()?></h4>
                        <p>Position: <?php echo $employerData->get_position()?></p>
                        <p>Start: <?php echo $employerData->get_startDate()?></p>
                        <p>End: <?php echo $employerData->get_endDate()?></p>
                        <p>Description: <?php echo $employerData->get_description()?></p>
                        <hr>
                    @endforeach
                    @else
                    <h4>No Employment history listed. Edit your profile to add employment history.</h4>
                    @endif

                </div>

                <div class="card" align="left">
                    <h1>Skills</h1>
                    @if($skillsList!=null)
                    @foreach($skillsList as $skill)
                        @if($skill->get_skillRating()==1)
                            <p> <?php echo $skill->get_skillName()?>: <span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>

                        @elseif($skill->get_skillRating()==2)
                            <p> <?php echo $skill->get_skillName()?>: <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>

                        @elseif($skill->get_skillRating()==3)
                            <p> <?php echo $skill->get_skillName()?>: <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
                        @elseif($skill->get_skillRating()==4)
                            <p> <?php echo $skill->get_skillName()?>: <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star"></span></p>
                        @elseif($skill->get_skillRating()==5)
                            <p> <?php echo $skill->get_skillName()?>: <span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span><span class="fa fa-star checked"></span></p>
                        @endif
                        <hr>
                    @endforeach
                    @else
                    <h4>No SKills listed. Edit your profile to add skills</h4>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
