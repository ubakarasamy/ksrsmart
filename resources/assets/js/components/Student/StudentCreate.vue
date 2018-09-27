<template>
<div class="home">
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Create Student Profile</h3>

	</div>
<div class="panel-body">
    <a href="/students" class="btn btn-primary float-right">Back</a>
	<div class="row">
        <div class="container">
            <div class="col-sm-6">
            <form @submit.prevent="CreateStudent()">
            <label for="name" class="">Name</label>
            <input v-model="name" type="text" class="form-control" placeholder="Name" id="name" name="name">
            <br>
            <label for="email" class="">Email</label>
            <input v-model="email" type="email" class="form-control" placeholder="Email" id="email" name="email">
            <br>
            <label for="reg_no" class="">Register Number</label>
            <input v-model="reg_no" type="text" class="form-control" placeholder="Register Number" id="reg_no" name="reg_no">
			<br>
            <label for="degree" class="">Degree</label>
            <select v-model="degree" class="form-control" id="degree" name="degree">
                <option selected disabled>Choose</option>
				<option v-for="degree_option in degree_options" v-bind:key="degree_option.value">{{degree_option.text}}</option>
			</select>
            <br>
            <label for="department" class="">Department</label>
			<select v-model="department" class="form-control" id="department" name="department">
            <option selected disabled>Choose</option>
				<option v-for="department_option in department_options" v-bind:key="department_option.value">{{department_option.text}}</option>
			</select>
            <br>
            <label for="year" class="">Year</label>
			<select v-model="year" class="form-control" id="year" name="year">
            <option selected disabled>Choose</option>
				<option v-for="year_option in year_options" v-bind:key="year_option.value">{{year_option.text}}</option>
			</select>
            <br>
            <label for="semester" class="">Semester</label>
			<select v-model="semester" class="form-control" id="semester" name="semester">
            <option selected disabled>Choose</option>
				<option v-for="semester_option in semester_options" v-bind:key="semester_option.value">{{semester_option.text}}</option>
			</select>
            <br>
            <label for="section" class="">Section</label>
			<select v-model="section" class="form-control" id="section" name="section">
            <option selected disabled>Choose</option>
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
</div>
</div>
</div>
</template>

<script>
    export default {

        data(){
            return {
                name:'',
                email:'',
                reg_no:'',
                degree:'',
                degree_options:[
                    {text:'BE', value:'be'},
                    {text:'ME', value:'me'}
                ],
                department:'',
                department_options:[
                    {text:'ECE', value:'ece'},
                    {text:'EEE', value:'eee'},
                    {text:'CSE', value:'cse'},
                    {text:'MECH', value:'mech'},
                    {text:'IT', value:'it'},
                    {text:'CIVIL', value:'cicil'},
                    {text:'AUTO', value:'auto'}
                ],
                year:'',
                year_options:[
                    {text:'1', value:'1'},
                    {text:'2', value:'2'},
                    {text:'3', value:'3'},
                    {text:'4', value:'4'}
                ],
                semester:'',
                semester_options:[
                    {text:'1', value:'1'},
                    {text:'2', value:'2'},
                    {text:'3', value:'3'},
                    {text:'4', value:'4'},
                    {text:'5', value:'5'},
                    {text:'6', value:'6'},
                    {text:'7', value:'7'},
                    {text:'8', value:'8'},
                ],
                section:'',
                section_options:[
                    {text:'a', value:'a'},
                    {text:'b', vblue:'a'},
                    {text:'c', vclue:'c'}
                ],
                status:'current',

            }
        },
              props:['authenticateduser', 'authrole'],
        methods:{
            CreateStudent(){
                let Formdata = {
                    name:this.name,
                    email:this.email,
                    reg_no:this.reg_no,
                    degree:this.degree.toLowerCase(),
                    department:this.department.toLowerCase(),
                    year:this.year,
                    semester:this.semester,
                    section:this.section,
                    status:this.status
                }

                fetch('/api/student/store', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {
                    // Work with JSON data here
                    if(data = 'success'){
                        alert('successfully Created');
                    }else{
                        alert('Something went wrong!');
                    }
                    console.log(data);
                }).catch(err => {
                    // Do something for an error here
                });

            }


            
        }
    }
</script>