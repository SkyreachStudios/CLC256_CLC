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
                <div class="panel-heading">E=Pro Groups</div>
                <!-- Add icon library -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


                    <div class="scrollit">

                        <h1>Groups</h1>


                        @if (isset($_SESSION) && isset($_SESSION['admin']) && $_SESSION['admin']==true)
                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#addJob">Add New Group</button>

                            <div id="addJob" class="collapse">
                                <br><br>
                                <form class="form-horizontal" role="form" method="POST" action="addGroup">
                                    {{ csrf_field() }}
                                    <div class = "form-group">
                                        <div class="col-md-6">
                                            <label for="title" class="col-md-4 control-label">Group Name</label>
                                            <input type="text" id="name" name="name" value= "Group Name">
                                        </div>
                                    </div>
                                    <div class = "form-group">
                                        <div class="col-md-6">
                                            <label for="desc" class="col-md-4 control-label">Group Description</label>
                                            <input type="text" id="desc" name="desc" value= "Description">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-4">
                                            <button type="submit" class="btn btn-info">
                                                <i class="fa fa-btn fa-briefcase"></i> Add Group
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        @endif



                        @if($groupsList!=null)
                            @if (isset($_SESSION) && isset($_SESSION['admin']) && $_SESSION['admin']==true)
                                @foreach($groupsList as $group)
                                    <div class="card">
                                        <button class="collapsible"><?php echo $group->getName()?></button>
                                        <div class="content">
                                            <p>Group Description: <?php echo $group->getDesc()?></p>
                                            <form class="form-horizontal" role="form" method="POST" action="updateGroup">
                                                {{ csrf_field() }}
                                                <input type ="hidden" name ='id' id="id" value = <?php echo $group->getId();?>>
                                                <div class = "form-group">
                                                    <div class="col-md-6">
                                                        <label for="name" class="col-md-4 control-label">Group Name</label>
                                                        <input type="text" id="name" name="name" value= <?php echo $group->getName()?>>
                                                    </div>
                                                </div>
                                                <div class = "form-group">
                                                    <div class="col-md-6">
                                                        <label for="desc" class="col-md-4 control-label">Group Description</label>

                                                        <textarea id="desc" name="desc" cols="35" rows="4">
                                                             <?php echo $group->getDesc()?>

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
                                        <form class="form-horizontal" role="form" method="POST" action="deleteGroup">
                                            {{ csrf_field() }}
                                            <input type ="hidden" name ='id' id="id" value = <?php echo $group->getId();?>>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-4">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i> Delete Group
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
                                @foreach($groupsList as $group)
                                    <div class="card">
                                        <button class="collapsible"><?php echo $group->getName()?></button>
                                        <div class="content">
                                            </p><p><?php echo $group->getDesc()?></p>

                                            <form class="form-horizontal" role="form" method="POST" action="visitPage">
                                                {{ csrf_field() }}
                                                <input type ="hidden" name ='id' id="id" value = <?php echo $group->getId();?>>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fa fa-btn fa-group"></i> Visit Group Page
                                                        </button>
                                                    </div>
                                                </div>
                                        </div>


                                            <br>

                                        </form>
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
