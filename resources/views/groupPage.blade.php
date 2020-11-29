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
                <div class="panel-heading">Group Dashboard</div>

                <!-- Add icon library -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                <div class="card">
                    <h2><?php echo $group->getName();?></h2>
                    <p><?php echo $group->getDesc();?></p>

                        @if($memberStatus==1)

                            <form class="form-horizontal" role="form" method="POST" action="leaveGroup">
                                {{ csrf_field() }}
                                <input type ="hidden" name ='id' id="id" value = <?php echo $group->getId();?>>
                                <input type = "hidden" name="userEmail" id="userEmail" value =><?php echo $_SESSION['username'];?>
                                <div class="form-group">
                                    <div >
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-btn fa-remove"></i> Leave Group
                                        </button>
                                    </div>
                                </div>
                                <br>
                            </form>

                        @elseif($memberStatus==0)

                            <form  class="form-horizontal" role="form" method="POST" action="joinGroup">
                                {{ csrf_field() }}
                                <input type ="hidden" name ='id' id="id" value = <?php echo $group->getId();?>>
                                <input type = "hidden" name="userEmail" id="userEmail" value =><?php echo $_SESSION['username'];?>
                                <div class="form-group">
                                    <div >
                                        <button type="submit" class="btn btn-user">
                                            <i class="fa fa-btn fa-user-circle-o"></i> Join Group
                                        </button>
                                    </div>
                                </div>
                                <br>
                            </form>

                        @endif


                </div>
                <div class="card">
                    <h1>Members</h1>
                    @if($members!=null)
                    @foreach($members as $member)
                        <h4><?php echo $member->getUserEmail()?></h4>
                        <hr>
                    @endforeach
                    @else
                    <h4>No Members in this Group.</h4>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
