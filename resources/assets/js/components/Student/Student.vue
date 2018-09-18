<template>
<div class="home">

    <!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Student Profile</h3>

        <a href="student/create" class="btn btn-primary float-right">Create Student</a>
	</div>
	<div class="panel-body">
		<div class="row">
			<!-- BASIC TABLE -->
            <div class="" v-if="edit === false">
                <div class="form-group d-select">
                    <label for="department" class="">Department</label>
			<select :disabled="disAccess" v-model="Fdepartment" class="form-control" id="department" name="department">
            <option selected disabled>Choose</option>
				<option v-for="Fdepartment_option in Fdepartment_options" v-bind:key="Fdepartment_option.value">{{Fdepartment_option.text}}</option>
			</select>
                </div>  
                <div class="table-responsive">
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
											<tr v-for="Stud in filteredStudents" v-bind:key="Stud.id">
                                                <td>{{Stud.reg_no}}</td>
												<td>{{Stud.name}}</td>
												<td>{{Stud.degree}}</td>
												<td>{{Stud.department}}</td>
												<td>{{Stud.year}}</td>
												<td>{{Stud.section}}</td>
                                                <td>
                                                    <button class="btn btn-primary" @click="EditClick(Stud)">
                                                        Edit
                                                    </button>
                                                </td>
											</tr>
										</tbody>
									</table>
								</div>
							
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
            <label for="reg_no" class="">Register Number</label>
            <input disabled="true" v-model="reg_no" type="text" class="form-control" placeholder="Register Number" id="reg_no" name="reg_no">
			<br>
            <label for="degree" class="">Degree</label>
            <select disabled="true" v-model="degree" class="form-control" id="degree" name="degree">
                <option selected >Choose</option>
				<option v-for="degree_option in degree_options" v-bind:key="degree_option.value">{{degree_option.text}}</option>
			</select>
            <br>
            <label for="department" class="">Department</label>
			<select disabled="true" v-model="department" class="form-control" id="department" name="department">
            <option selected >Choose</option>
				<option v-for="department_option in department_options" v-bind:key="department_option.value">{{department_option.text}}</option>
			</select>
            <br>
            <label for="year" class="">Year</label>
			<select disabled="true" v-model="year" class="form-control" id="year" name="year">
            <option selected >Choose</option>
				<option v-for="year_option in year_options" v-bind:key="year_option.value">{{year_option.text}}</option>
			</select>
            <br>
            <label for="semester" class="">Semester</label>
			<select disabled="true" v-model="semester" class="form-control" id="semester" name="semester">
            <option selected >Choose</option>
				<option v-for="semester_option in semester_options" v-bind:key="semester_option.value">{{semester_option.text}}</option>
			</select>
            <br>
            <label for="section" class="">Section</label>
			<select disabled="true" v-model="section" class="form-control" id="section" name="section">
            <option selected >Choose</option>
				<option v-for="section_option in section_options" v-bind:key="section_option.value">{{section_option.text}}</option>
			</select>
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
            <label class="">Year</label>
			<p v-text="year"></p>
            <br>
            <label  class="">Semester</label>
			<p v-text="semester"></p>
            <br>
            <label  class="">Section</label>
            <p v-text="section"></p>
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
            Studs:[],
            edit:false,

            disAccess:'',
           Fdepartment:'',
                Fdepartment_options:[
                    {text:'ECE', value:'ece'},
                    {text:'EEE', value:'eee'},
                    {text:'CSE', value:'cse'},
                    {text:'MECH', value:'mech'},
                    {text:'IT', value:'it'},
                    {text:'CIVIL', value:'cicil'},
                    {text:'AUTO', value:'auto'},
                ],
            name:'',
                email:'',
                reg_no:'',
                degree:'',
                degree_options:'',
                department:'',
                department_options:'',
                year:'',
                year_options:'',
                semester:'',
                semester_options:'',
                section:'',
                section_options:'',
                status:'',
                student_id:''

        }
    },
          props:['authenticateduser', 'authrole'],
    mounted() {
        this.getAllStudents();
    },
    methods:{
        getAllStudents(){
            fetch('/api/students')
            .then(res => {
                return res.json();
            })
            .then(data => {
                this.Studs = data;
            }).catch(err => console.log(err));
        },
        EditClick(Stud){
            this.edit = true;
            this.name = Stud.name;
            this.email = Stud.email;
            this.reg_no = Stud.reg_no;
            this.department = Stud.department;
            this.degree = Stud.degree;
            this.year = Stud.year;
            this.semester = Stud.semester;
            this.section = Stud.section;
            this.status = Stud.status;
            this.student_id = Stud.id;
        },

        EditStudent(){
                let Formdata = {
                    name:this.name,
                    email:this.email,
                    reg_no:this.reg_no,
                    degree:this.degree,
                    department:this.department,
                    year:this.year,
                    semester:this.semester,
                    section:this.semester,
                    status:this.status,
                    student_id:this.student_id
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

    },
    computed:{
        filteredStudents(){
            
            let Students = this.Studs;

            let w_dapart = this.authenticateduser.working_department;


             if(this.authrole === 3 || this.authrole === 4){ //if user is hod or professor show their staffs
                    this.Fdepartment = w_dapart;
                    this.disAccess = true;
                }

                let depart = this.Fdepartment.toLowerCase();

            if(depart === ""){
                return Students;
            }else{
                return Students.filter(function(stud){
                    return stud.department === depart;
                });
            }
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
.d-select
{
    margin-bottom: 30px;
    width: 250px;
}
</style>
