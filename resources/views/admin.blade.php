
@extends('layouts.app')

@section('content')
    <?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<div>
<div >
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div >
                    <h2 class="pull-left">User Details</h2>
                   <!-- <a href="create.php" class="btn btn-success pull-right">Add New User</a>-->
                </div>
                <table class="table table-bordered table-striped">
                    <thread>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Admin Priviledges</th>
                            <th>Suspended?</th>
                        </tr>
                    </thread>
                    <tbody>


                    @foreach($memberProfileList as $member)




                    <tr>
                        <form  role="form" method="POST" action="adminUpdate" >
                            {{ csrf_field() }}
                            <td > <?php echo "".$member->get_id();?></td>
                            <input type="hidden"  name ="id" id="id" value = <?php echo $member->get_id();?>>
                            <td><input name = "name" id="name" type = text value = <?php echo "".$member->get_name();?>></td>
                    <td> <input type="text" name = "email" id="email" value = <?php echo "".$member->get_email();?>></td>
                    <td><input type = "text" name = "password" id="password" value =<?php echo "".$member->get_password();?>></td>
                    <td>
                        <select name="admin" id = "admin" >
                            <?php
                            if($member->get_admin() == 0){
                                echo "<option value = '0'>User</option>";
                                echo "<option value = '1'>Admin</option>";

                            }
                            else{
                                echo "<option value = '1'>Admin</option>";
                                echo "<option value = '0'>User</option>";

                            }
                            ?>
                        </select>
                            </td>

                    <td>
                        <select name="suspended" id = "suspended" >
                            <?php
                            if($member->get_suspended() == 0){
                                echo "<option value = '0'>Active</option>";
                                echo "<option value = '1'>Suspended</option>";

                            }
                            else{
                                echo "<option value = '1'>Suspended</option>";
                                echo "<option value = '0'>Active</option>";

                            }
                            ?>
                        </select>
                    </td>

                    </td>
                        <td>



                                <button type="submit">Update</button>
                            <br>
                            </form>
                        <form role="form" method="POST" action="adminDelete" >
                            {{ csrf_field() }}
                            <input type="hidden"  name ="id" id="id" value = <?php echo $member->get_id();?>>
                            <input type="hidden"  name ="name" id="name" value = <?php echo $member->get_name();?>>
                            <input type="hidden"  name ="email" id="email" value = <?php echo $member->get_email();?>>
                            <input type="hidden"  name ="password" id="password" value = <?php echo $member->get_password();?>>
                            <input type="hidden"  name ="admin" id="admin" value = <?php echo $member->get_admin();?>>
                            <input type="hidden"  name ="suspended" id="suspended" value = <?php echo $member->get_suspended();?>>
                            <button type="submit">Delete</button>

                        </form>



                        </td>
                    </tr>









                    @endforeach

                    </tbody>


                </table>
                <!--

                                            if($row['admin']==0){
                                                $admin="User";
                                            }
                                            else{
                                                $admin="Admin";
                                            }

                                            if($row['suspended']==0){
                                                $suspended = "Active";
                                            }
                                            else{
                                                $suspended = "Suspended";
                                            }

                                            echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['password'] . "</td>";
                                            echo "<td>" . $admin  . "</td>";
                                            echo "<td>" . $suspended . "</td>";
                                            echo "<td>"; -->


            </div>
        </div>
    </div>
</div>



@endsection
