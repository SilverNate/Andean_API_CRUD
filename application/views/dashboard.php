<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/vue"></script>
</head>
<body>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group" v-if="!mode">
                    <form action="" method="post">
                        <input type="text" hidden="hidden" v-model="no">
                        <label>name</label>
                        <input type="text" class="form-control" v-model="name">
                        <label>email</label>
                        <input type="text" class="form-control" v-model="email">
                        <label>password</label>
                        <input type="text" class="form-control" v-model="password">
                        <label>gender</label>
                        <input type="text" class="form-control" v-model="gender">
                        <label>ismarried</label>
                        <input type="text" class="form-control" v-model="ismarried">
                        <label>address</label>
                        <input type="text" class="form-control" v-model="address">
                        <br>
                        <button type="button" @click="sendData()" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <div class="form-group" v-if="mode">
                    <form v-for="data in user" action="" method="post">
                        <input type="text" hidden="hidden" v-model="data.no" id="no">
                        <label>name</label>
                        <input type="text" class="form-control" v-model="data.name" id="name">
                        <label>email</label>
                        <input type="text" class="form-control" v-model="data.email" id="email">
                        <label>password</label>
                        <input type="text" class="form-control" v-model="data.password" id="password">
                        <label>gender</label>
                        <input type="text" class="form-control" v-model="data.gender" id="gender">
                        <label>ismarried</label>
                        <input type="text" class="form-control" v-model="data.ismarried" id="ismarried">
                        <label>address</label>
                        <input type="text" class="form-control" v-model="data.address" id="address">
                        <br>
                        <button type="button" @click="updateData()" class="btn btn-success">Update</button>
                        <button type="button" @click="clearme()" class="btn btn-info">Clear</button>
                    </form>
                </div>

            </div>
            <div class="col-sm-8">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>email</th>
                            <th>password</th>
                            <th>gender</th>
                            <th>ismarried</th>
                            <th>address</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users">
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.password }}</td>
                            <td>{{ user.gender }}</td>
                            <td>{{ user.ismarried }}</td>
                            <td>{{ user.address }}</td>
                            <td> 
                                <button @click="updateThis(user.no)" class="btn btn-success">Update</button>
                                <button @click="deleteData(user.no)" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <script>
        app = new Vue({
            el: ".container",
            data: {
                mode      : false,
                user      : [],
                users     : [],
                no        : "",
                name      : "",
                email     : "",
                password  : "",
                gender    : "",
                ismarried : "",
                address   : "",
            },
            methods: {
                clearme: function(){
                    this.mode = false
                    this.user = []
                },
                getData: function () {
                    fetch('../api/user')
                        .then(response => response.json())
                        .then(api => {
                            this.users = api.Result;
                        })
                },
                getOneData: function (no) {
                    fetch('../api/user?no='+no)
                        .then(response => response.json())
                        .then(api => {
                            this.user = api.Result;
                        })
                },
                updateThis: function(no){
                    this.getOneData(no)
                    this.mode = true;
                },
                sendData: function(){
                    proxy = this;
                    $.ajax({
                        url: "../api/user",
                        type: "POST",
                        data: {
                            "name"      : this.name,
                            "email"     : this.email,
                            "password"  : this.password,
                            "gender"    : this.gender,
                            "ismarried" : this.ismarried,
                            "address"   : this.address
                        },
                        success: function (response) {
                            console.log("Data Successfully Created!")
                            alert(response);
                            proxy.getData();
                        },
                    });
                },
                updateData: function () {
                    proxy = this;
                    $.ajax({
                        url: "../api/user",
                        type: "PUT",
                        data: {
                            "no": $('#no').val(),
                            "name": $('#name').val(),
                            "email": $('#email').val(),
                            "password": $('#password').val(),
                            "gender": $('#gender').val(),
                            "ismarried": $('#ismarried').val(),
                            "address": $('#address').val(),
                        },
                        success: function (response) {
                            console.log("Data Successfully Updated!")
                            alert("Data Successfully Updated!");
                            proxy.getData()
                        },
                    });
                },
                deleteData: function (no) {
                    proxy = this;
                    $.ajax({
                        url: "../api/user",
                        type: "DELETE",
                        data: {
                            "no": no,
                        },
                        success: function (response) {
                            console.log("Data Successfully Deleted!")
                            alert("Data Successfully Deleted!");
                            proxy.getData()
                        },
                    });
                }
            },
            created() {
                this.getData()
            }
        })
    </script>
</body>
</html>