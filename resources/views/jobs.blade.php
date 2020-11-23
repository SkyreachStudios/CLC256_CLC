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
        .scrollit {
            overflow:scroll;
            height:1000px;
        }

        .collapsible {
            background-color: #777;
            color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
        }

        .active, .collapsible:hover {
            background-color: #555;
        }

        .collapsible:after {
            content: '\002B';
            color: white;
            font-weight: bold;
            float: right;
            margin-left: 5px;
        }

        .active:after {
            content: "\2212";
        }

        .content {
            padding: 0 18px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            background-color: #f1f1f1;
        }


    </style>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">E=Pro Job Board</div>
                <!-- Add icon library -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


                    <div class="scrollit">

                        <h1>Job listings</h1>


                        @if (isset($_SESSION) && isset($_SESSION['admin']) && $_SESSION['admin']==true)
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#addJob">Add New Job</button>

                            <div id="addJob" class="collapse">
                                <br><br>
                                <form class="form-horizontal" role="form" method="POST" action="addJob">
                                    {{ csrf_field() }}
                                    <div class = "form-group">
                                        <div class="col-md-6">
                                            <label for="title" class="col-md-4 control-label">Title</label>
                                            <input type="text" id="title" name="title" value= "Title">
                                        </div>
                                    </div>
                                    <div class = "form-group">
                                        <div class="col-md-6">
                                            <label for="company" class="col-md-4 control-label">Company</label>
                                            <input type="text" id="company" name="company" value= "Company Name">
                                        </div>
                                    </div>
                                    <div class = "form-group">
                                        <div class="col-md-6">
                                            <label for="location" class="col-md-4 control-label">Location</label>
                                            <input type="text" id="location" name="location" value= "Job Location">
                                        </div>
                                    </div>
                                    <div class = "form-group">
                                        <div class="col-md-6">
                                            <label for="salary" class="col-md-4 control-label">Salary</label>
                                            <input type="text" id="salary" name="salary" value= "Salary">
                                        </div>
                                    </div>
                                    <div class = "form-group">
                                        <div class="col-md-6">
                                            <label for="description" class="col-md-4 control-label">Description</label>
                                            <textarea id="description" name="description" rows="5" cols="35"></textarea>
                                        </div>
                                    </div>
                                    <div class = "form-group">
                                        <div class="col-md-6">
                                            <label for="qualifications" class="col-md-4 control-label">Qualifications</label>
                                            <textarea id="qualifications" name="qualifications" rows="5" cols="35"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-4">
                                            <button type="submit" class="btn btn-info">
                                                <i class="fa fa-btn fa-briefcase"></i> Add Job
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        @endif



                        @if($jobsList!=null)
                            @if (isset($_SESSION) && isset($_SESSION['admin']) && $_SESSION['admin']==true)
                                @foreach($jobsList as $job)
                                    <div class="card">
                                        <button class="collapsible"><?php echo $job->getTitle()?></button>
                                        <div class="content">
                                            <p>Company: <?php echo $job->getCompany()?></p>
                                            <p>Location: <?php echo $job->getLocation()?></p>
                                            <p>Salary: <?php echo $job->getSalary()?></p>
                                            <p>Basic Qualifications: <?php echo $job->getQualifications()?>
                                            </p><p><?php echo $job->getDescription()?></p>
                                            <form class="form-horizontal" role="form" method="POST" action="updateJob">
                                                {{ csrf_field() }}
                                                <input type ="hidden" name ='id' id="id" value = <?php echo $job->getId();?>>
                                                <div class = "form-group">
                                                    <div class="col-md-6">
                                                        <label for="title" class="col-md-4 control-label">Title</label>
                                                        <input type="text" id="title" name="title" value= <?php echo $job->getTitle()?>>
                                                    </div>
                                                </div>
                                                <div class = "form-group">
                                                    <div class="col-md-6">
                                                        <label for="company" class="col-md-4 control-label">Company</label>
                                                        <input type="text" id="company" name="company" value= <?php echo $job->getCompany()?>>
                                                    </div>
                                                </div>
                                                <div class = "form-group">
                                                    <div class="col-md-6">
                                                        <label for="location" class="col-md-4 control-label">Position</label>
                                                        <input type="text" id="location" name="location" value= <?php echo $job->getLocation()?>>
                                                    </div>
                                                </div>
                                                <div class = "form-group">
                                                    <div class="col-md-6">
                                                        <label for="salary" class="col-md-4 control-label">Salary</label>
                                                        <input type="text" id="salary" name="salary" value= <?php echo $job->getSalary()?>>
                                                    </div>
                                                </div>
                                                <div class = "form-group">
                                                    <div class="col-md-6">
                                                        <label for="description" class="col-md-4 control-label">Description</label>
                                                        <textarea id="description" name="description" rows="5" cols="35">
                                                            <?php echo $job->getDescription()?>

                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class = "form-group">
                                                    <div class="col-md-6">
                                                        <label for="qualifications" class="col-md-4 control-label">Qualifications</label>
                                                        <textarea id="qualifications" name="qualifications" rows="5" cols="35">
                                                            <?php echo $job->getQualifications()?>

                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-4">
                                                        <button type="submit" class="btn btn-info">
                                                            <i class="fa fa-btn fa-briefcase"></i> Update Job
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>
                                        <form class="form-horizontal" role="form" method="POST" action="deleteJob">
                                            {{ csrf_field() }}
                                            <input type ="hidden" name ='id' id="id" value = <?php echo $job->getId();?>>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-4">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i> Delete Job
                                                    </button>
                                                </div>
                                            </div>
                                            <br>

                                        </form>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach


                            @elseif(isset($_SESSION) && isset($_SESSION['admin']) && $_SESSION['admin']==false)
                                @foreach($jobsList as $job)
                                    <div class="card">
                                        <button class="collapsible"><?php echo $job->getTitle()?></button>
                                        <div class="content">
                                            <p>Company: <?php echo $job->getCompany()?></p>
                                            <p>Location: <?php echo $job->getLocation()?></p>
                                            <p>Salary: <?php echo $job->getSalary()?></p>
                                            <p>Basic Qualifications: <?php echo $job->getQualifications()?>
                                            </p><p><?php echo $job->getDescription()?></p>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach

                            @else

                            <h4>No jobs currently available.</h4>
                            @endif
                        @endif
                </div>

            </div>
        </div>
    </div>
</div>

    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight){
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }
    </script>
@endsection
