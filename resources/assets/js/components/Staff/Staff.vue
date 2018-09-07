<template>
<div class="home">

    <!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Student Profile</h3>

        <a href="/student/create" class="btn btn-primary float-right">Create Student</a>
	</div>
	<div class="panel-body">
		<div class="row">
			<!-- BASIC TABLE -->
            <div class="panel table-responsive" v-if="edit === false">
									<table class="table">
										<thead>
											<tr>
												<th>#Register No</th>
												<th>Name</th>
												<th>Degree</th>
												<th>Department</th>
                                                <th>Year</th>
                                                <th>Section</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="Stud in Studs" v-bind:key="Stud.id">
                                                <td>{{Stud.reg_no}}</td>
												<td>{{Stud.name}}</td>
												
                                                <td>
                                                    <button class="btn btn-primary" @click="EditClick(Staff)">
                                                        Edit
                                                    </button>
                                                </td>
											</tr>
										</tbody>
									</table>
								
							
		            </div>
                    <!-- END BASIC TABLE -->
            <div class="row form"  v-if="edit === true">
                <button class="btn btn-primary" @click="ClickBack()">Back</button>
        <div class="container">
            <div class="col-sm-6">
            <form @submit.prevent="EditStudent()">
            <label for="name" class="">Name</label>
            <input v-model="name" type="text" class="form-control" placeholder="Name" id="name" name="name">
            <br>
            <label for="email" class="">Email</label>
            <input v-model="email" type="email" class="form-control" placeholder="Email" id="email" name="email">
            <br>
            <label for="eid" class="">Employee ID Number</label>
            <input disabled="true" v-model="eid" type="text" class="form-control" placeholder="Register Number" id="eid" name="eid">
            <br>
            <label for="department" class="">Department</label>
			<select disabled="true" v-model="department" class="form-control" id="department" name="department">
            <option selected >Choose</option>
				<option v-for="department_option in department_options" v-bind:key="department_option.value">{{department_option.text}}</option>
			</select>
            <br>
            <label for="role" class="">Role</label>
			<select disabled="true" v-model="role" class="form-control" id="role" name="role">
            <option selected >Choose</option>
				<option v-for="role_option in role_options" v-bind:key="role_option.value">{{role_option.text}}</option>
			</select>
            <br>

            <label for="occupation" class="">occupation</label>
			<select disabled="true" v-model="occupation" class="form-control" id="occupation" name="occupation">
            <option selected >Choose</option>
				<option v-for="occupation_option in occupation_options" v-bind:key="occupation_option.value">{{occupation_option.text}}</option>
			</select>
            <br>
            <label for="status" class="">status</label>
			<select disabled="true" v-model="status" class="form-control" id="status" name="status">
            <option selected >Choose</option>
				<option v-for="status_option in status_options" v-bind:key="status_option.value">{{status_option.text}}</option>
			</select>
            <br>
            <label for="password" class="">password</label>
            <input v-model="name" type="password" class="form-control" placeholder="password" id="password" name="password">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>		
            </div>
            <div class="col-sm-6">
            <label class="">Name</label>
            <p v-text="name"></p>
            <br>
            <label  class="">Email</label>
            <p  v-text="email"></p>
            <br>
            <label  class="">Register Number</label>
            <p v-text="reg_no"></p>
			<br>
            <label  class="">Degree</label>
            <p v-text="degree"></p>
            <br>
            <label  class="">Department</label>
			<p v-text="department"></p>
            <br>
            <label class="">role</label>
			<p v-text="role"></p>
            <br>
            <label  class="">occupation</label>
			<p v-text="occupation"></p>
            <br>
            <label  class="">status</label>
            <p v-text="status"></p>
            <br>
            </div>
        </div>			
	</div>
    <!-- gfd -->

	</div>
</div>
</div>
</div>
</template>


<script>
export default {
    data(){
        return{
            Staffs:[],
            edit:false,

            name:'',
                email:'',
                eid:'',
                degree:'',
                working_department:'',
                dashboard_role:'',
                occupation:'',
                status:'',
                password:''
        }
    },
    mounted() {
        this.getAllStudents();
    },
    methods:{
        getAllStudents(){
            fetch('/api/staffs')
            .then(res => {
                return res.json();
            })
            .then(data => {
                this.Studs = data;
            }).catch(err => console.log(err));
        },
        EditClick(Stud){
            this.edit = true;
            this.name = Staff.name;
            this.email = Staff.email;
            this.eid = Staff.eid;
            this.working_department = Staff.working_department;
            this.dashboard_role = Staff.dashboard_role;
            this.occupation = Staff.occupation;
            this.status = Staff.status;
            this.password = Staff.password;
            this.staff_id = Staff.id;
        },

        EditStudent(){
                let Formdata = {
                    name:this.name,
                    email:this.email,
                    eid:this.eid,
                    working_department:this.working_department,
                    dashboard_role:this.dashboard_role,
                    occupation:this.occupation,
                    semester:this.semester,
                    password:this.password,
                    staff_id:this.staff_id,
                }

                fetch('/api/student/update', {
                    method: "put",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {
                    const dt = data;
                    if(dt === 'success'){
                        alert('Successfully Updated');
                    }else{
                        alert('Something went wrong!');
                    }
                }).catch(err => {
                    console.log(err);
                });
            },

            ClickBack(){
                this.edit = false;
            }

    }
}
</script>

<style scoped>
.panel-heading::after
{
    content: "";
    clear: both;
    display: block;
}
</style>
