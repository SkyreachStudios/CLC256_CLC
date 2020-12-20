@extends('layouts.app')

@section('content')
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Profile Data</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="doEdit" >
                        {{ csrf_field() }}
                        <div class = "form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <input type="text" id="name" name="name" value= <?php echo $name?>>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <input type="email" id="email" name="email" value= <?php echo $username?>>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class = "form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                            <div class = "col-md-6">
                                <label for="age" class="col-md-4 control-label">Age</label>
                                <input type="number" id="age" name="age" value= <?php echo $age?>>
                                @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div>

                        </div>
                        <div class = "form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <label for="gender" class="col-md-4 control-label">Gender</label>
                                <input type="text" id="gender" name="gender" value= <?php echo $gender?>>
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class = "form-group {{ $errors->has('education') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <label for="education" class="col-md-4 control-label">Education</label>
                                <input type="text" id="education" name="education" value= <?php echo $education?>>
                                @if ($errors->has('education'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('education') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class = "form-group {{ $errors->has('employer') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <label for="employer" class="col-md-4 control-label">Most Recent Employer</label>
                                <input type="text" id="employer" name="employer" value= <?php echo $employer?>>
                                @if ($errors->has('employer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('employer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Update Info
                                </button>
                            </div>
                        </div>
                    </form>




                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Employment Data</div>
                <div class="panel-body">


                         @if($employmentList!=null)
                            @foreach($employmentList as $employerData)

                        <form class="form-horizontal" role="form" method="POST" action="updateEmploymentData" >
                            {{ csrf_field() }}

                                        <input type ="hidden" name ='id' id="id" value = <?php echo $employerData->get_id();?>>
                                        <input type ="hidden" name ='userid' id="userid" value = <?php echo $employerData->get_userID();?>>
                            <div class = "form-group {{ $errors->has('company') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                        <label for ="company" class="col=md-4-control-label">Company</label><br>
                                        <input type="text" name="company" id="company" value= <?php echo $employerData->get_company();?>>
                                    @if ($errors->has('company'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class = "form-group {{ $errors->has('position') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                        <label for="position" class="col-md-4-control-label">Position</label><br>
                                        <input type="text" name="position" id="position" value= <?php echo $employerData->get_position();?>>
                                    @if ($errors->has('position'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                                    <div class = "form-group {{ $errors->has('start') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                        <label for="start" class="col-md-4-control-label">Start Date</label><br>
                                        <input type="date" name="start" id="start" value= <?php echo $employerData->get_startDate();?>>
                                            @if ($errors->has('start'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('start') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                            <div class = "form-group {{ $errors->has('end') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                        <!-end date->
                                        <label for="end" class="col-md-4-control-label">End Date</label><br>
                                        <input type="date" name="end" id="end" value= <?php echo $employerData->get_endDate();?>>
                                    @if ($errors->has('end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class = "form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                        <!-description text area->
                                        <label for="description" class="col-md-4-control-label">Job Duties</label>
                                        <textarea name="description" id="description" rows="3" cols="35">
                                            <?php echo $employerData->get_description();?>
                                          </textarea>
                                    <br>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                        <div class="col-md-6 col-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-btn fa-user"></i> Update Employer Data
                                            </button>
                                        </div>
                                        </div>
                                    </form>

                                    <form class="form-horizontal" role="form" method="POST" action="deleteEmployer">
                                        {{ csrf_field() }}
                                        <input type ="hidden" name ='id' id="id" value = <?php echo $employerData->get_id();?>>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-4">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i> Delete Employment
                                                </button>
                                            </div>
                                        </div>
                                        <br>
                                    </form>
                            @endforeach

                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">+</button>
                            <div id="demo" class="collapse">
                                <form class="form-horizontal" role="form" method="POST" action="addEmployer">
                                    {{ csrf_field() }}
                                    <div class = "form-group {{ $errors->has('company') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label for="company" class="col-md-4 control-label">Company</label>
                                            <input type="text" id="company" name="company" value= "Company Name">
                                            @if ($errors->has('company'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class = "form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label for="position" class="col-md-4 control-label">Position</label>
                                            <input type="text" id="position" name="position" value= "Position at job">
                                            @if ($errors->has('position'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class = "form-group {{ $errors->has('start') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label for="start" class="col-md-4 control-label">Start Date</label>
                                            <input type="date" id="start" name="start" value= <?php echo ""?>>
                                            @if ($errors->has('start'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('start') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class = "form-group {{ $errors->has('end') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label for="end" class="col-md-4 control-label">End Date</label>
                                            <input type="date" id="end" name="end" value= <?php echo ""?>>
                                            @if ($errors->has('end'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class = "form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label for="duties" class="col-md-4 control-label">Duties</label>
                                            <textarea id="description" name="description" rows="5" cols="35"></textarea>
                                            @if ($errors->has('description '))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-4">
                                            <button type="submit" class="btn btn-info">
                                                <i class="fa fa-btn fa-briefcase"></i> Add Employment
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                    @else
                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">+</button>
                    <div id="demo" class="collapse">
                        <form class="form-horizontal" role="form" method="POST" action="addEmployer">
                            {{ csrf_field() }}

                            <div class = "form-group {{ $errors->has('company') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label for="company" class="col-md-4 control-label">Company</label>
                                    <input type="text" id="company" name="company" value= "Company Name">
                                    @if ($errors->has('company'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class = "form-group {{ $errors->has('position') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label for="position" class="col-md-4 control-label">Position</label>
                                    <input type="text" id="position" name="position" value= "Position at job">
                                    @if ($errors->has('position'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class = "form-group {{ $errors->has('start') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label for="start" class="col-md-4 control-label">Start Date</label>
                                    <input type="date" id="start" name="start" value= <?php echo ""?>>
                                    @if ($errors->has('start'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class = "form-group {{ $errors->has('end') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label for="end" class="col-md-4 control-label">End Date</label>
                                    <input type="date" id="end" name="end" value= <?php echo ""?>>
                                    @if ($errors->has('end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class = "form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label for="duties" class="col-md-4 control-label">Duties</label>
                                    <textarea id="description" name="description" rows="5" cols="35"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-4">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-btn fa-briefcase"></i> Add Employment
                                    </button>
                                </div>
                            </div>

                        </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>



    <!-Skills Elements->

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Skills</div>
                <div class="panel-body">


@if($skillsList!=null)
                    @foreach($skillsList as $skill)

                        <form class="form-horizontal" role="form" method="POST" action="updateSkill" >
                            {{ csrf_field() }}

                            <input type ="hidden" name ='id' id="id" value = <?php echo $skill->get_id();?>>
                            <input type ="hidden" name ='userid' id="userid" value = <?php echo $skill->get_userID();?>>
                            <div class = "form-group {{ $errors->has('skillName') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label for ="skillName" class="col=md-4-control-label">Skill Name</label><br>
                                    <textarea cols="20" rows="3" name="skillName" id="skillName">
                                        <?php echo $skill->get_skillName();?>
                                    </textarea>
                                    @if ($errors->has('skillName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('skillName') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class = "form-group {{ $errors->has('skillRating') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label for="skillRating" class="col-md-4-control-label">Skill Rating</label><br>
                                    <select name="skillRating" id = "skillRating" >
                                        <?php
                                        if($skill->get_skillRating() == 1){
                                            echo "<option value = '1'>New</option>";
                                            echo "<option value = '2'>Beginner</option>";
                                            echo "<option value = '3'>Intermediate</option>";
                                            echo "<option value = '4'>Advanced</option>";
                                            echo "<option value = '5'>Expert</option>";

                                        }
                                        elseif($skill->get_skillRating() == 2){
                                            echo "<option value = '2'>Beginner</option>";
                                            echo "<option value = '1'>New</option>";
                                            echo "<option value = '3'>Intermediate</option>";
                                            echo "<option value = '4'>Advanced</option>";
                                            echo "<option value = '5'>Expert</option>";
                                        }
                                        if($skill->get_skillRating() == 3){
                                            echo "<option value = '3'>Intermediate</option>";
                                            echo "<option value = '1'>New</option>";
                                            echo "<option value = '2'>Beginner</option>";
                                            echo "<option value = '4'>Advanced</option>";
                                            echo "<option value = '5'>Expert</option>";

                                        }
                                        elseif($skill->get_skillRating() == 4){
                                            echo "<option value = '4'>Advanced</option>";
                                            echo "<option value = '2'>Beginner</option>";
                                            echo "<option value = '1'>New</option>";
                                            echo "<option value = '3'>Intermediate</option>";
                                            echo "<option value = '5'>Expert</option>";
                                        }
                                        elseif($skill->get_skillRating()==5){
                                            echo "<option value = '5'>Expert</option>";
                                            echo "<option value = '2'>Beginner</option>";
                                            echo "<option value = '1'>New</option>";
                                            echo "<option value = '3'>Intermediate</option>";
                                            echo "<option value = '4'>Advanced</option>";
                                        }




                                        ?>
                                    </select>
                                    @if ($errors->has('skillRating'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('skillRating') }}</strong>
                                    </span>
                                    @endif


                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Update Skill
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form class="form-horizontal" role="form" method="POST" action="deleteSkill">
                            {{ csrf_field() }}
                            <input type ="hidden" name ='id' id="id" value = <?php echo $skill->get_id();?>>

                            <div class="form-group">
                                <div class="col-md-6 col-md-4">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i> Delete Skill
                                    </button>
                                </div>
                            </div>
                            <br>

                        </form>
                    @endforeach
                    @endif



                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#addSkill">+</button>
                    <div id="addSkill" class="collapse">
                        <form class="form-horizontal" role="form" method="POST" action="addSkill">
                            {{ csrf_field() }}

                            <div class = "form-group {{ $errors->has('skillName') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label for="company" class="col-md-4 control-label">Skill Name</label>
                                    <input type="text" id="skillName" name="skillName" value= "Skill Name">
                                    @if ($errors->has('skillName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('skillName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class = "form-group {{ $errors->has('skillRating') ? ' has-error' : '' }}">
                                <div class="col-md-6">
                                    <label for="skillRating" class="col-md-4 control-label">Skill Rating</label>
                                    <select name="skillRating" id = "skillRating" >
                                        <option value ='1'>New</option>
                                        <option value ='2'>Beginner</option>
                                        <option value ='3'>Intermediate</option>
                                        <option value ='4'>Advanced</option>
                                        <option value ='5'>Expert</option>
                                    </select>
                                    @if ($errors->has('skillRating'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('skillRating') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-4">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-btn fa-star"></i> Add Skill
                                    </button>
                                </div>
                            </div>

                        </form>


                    </div>





                </div>
            </div>
        </div>
    </div>
</div>
</div>





    </body>
@endsection
