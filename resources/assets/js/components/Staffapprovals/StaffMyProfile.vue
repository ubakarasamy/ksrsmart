<template>
    <div class="home">

<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">My Profile</h3>

	</div>
<div class="panel-body">
    <div class="row form">
        <button class="btn btn-primary edit-button" @click="ClickEdit()">Edit Profile</button>
        <div class="row">
             <div class="col-sm-6">
            <label class="">Name</label>
            <p v-text="name"></p>
            <br>
            <label  class="">Email</label>
            <p  v-text="email"></p>
            <br>
            <label  class="">Register Number</label>
            <p v-text="eid"></p>
			<br>
            <label  class="">Department</label>
			<p v-text="working_department"></p>
            <br>
            
            <label  class="">occupation</label>
			<p v-text="occupation"></p>
            <br>
            
            </div>
            <div class="col-sm-6" v-if="edit === true">
            <form @submit.prevent="SaveEditited()">
            <label for="name" class="">Name</label>
            <input disabled="true" v-model="name" type="text" class="form-control" placeholder="Name" id="name" name="name">
            <br>
            <label for="email" class="">Email</label>
            <input v-model="email" type="email" class="form-control" placeholder="Email" id="email" name="email">
            <br>
            <label for="eid" class="">Employee ID Number</label>
            <input disabled="true" v-model="eid" type="text" class="form-control" placeholder="Register Number" id="eid" name="eid">
            <br>
            <label for="department" class="">Department</label>
			<select disabled="true" v-model="working_department" class="form-control" id="department" name="department">
            <option selected >Choose</option>
				<option v-for="department_option in department_options" v-bind:key="department_option.value">{{department_option.text}}</option>
			</select>
            <br>
         
            <label for="occupation" class="">occupation</label>
			<select disabled="true" v-model="occupation" class="form-control" id="occupation" name="occupation">
            <option selected >Choose</option>
				<option v-for="occupation_option in occupation_options" v-bind:key="occupation_option.value">{{occupation_option.text}}</option>
			</select>
            <br>
     
            <label for="password" class="">password</label>
            <input v-model="password" type="password" class="form-control" placeholder="password" id="password" name="password">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>		
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
        return{
            edit:'',

            name:'',
            email:'',
            eid:'',
            password:'',
            working_department:'',
            occupation:'',

                department_options:[
                    {text:'ECE', value:'ece'},
                    {text:'EEE', value:'eee'},
                    {text:'CSE', value:'cse'},
                    {text:'MECH', value:'mech'},
                    {text:'IT', value:'it'},
                    {text:'CIVIL', value:'cicil'},
                    {text:'AUTO', value:'auto'},
                ],

                occupation_options:[
                    {text:'Hod', value:'hod'},
                    {text:'Professor', value:'professor'},
                    {text:'Associate Professor', value:'associateprofessor'},
                    {text:'Lab Incharge', value:'labincharge'},
                    {text:'Non Teaching', value:'nonteaching'}

                ]

        }
    },
    mounted(){
        this.getAuthuserData();
    },
         props:['authenticateduser', 'authrole'],

    methods:{

        getAuthuserData(){
            let vm = this;
            vm.name = vm.authenticateduser.name;
            vm.email = vm.authenticateduser.email;
            vm.name = vm.authenticateduser.name;
            vm.eid = vm.authenticateduser.eid;
            vm.working_department = vm.authenticateduser.working_department;
            vm.password = vm.authenticateduser.password;
            vm.occupation = vm.authenticateduser.occupation;
        },

        ClickEdit(){
            this.edit = true;
        },
        SaveEditited(){
            let Formdata = {
                user_id:this.authenticateduser.id,
                password:this.password,
                email:this.email
            }
            fetch('/api/staff/profile/update', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
            })
            .then(res => {
                return res.json();
            }).then(data => {

            }).catch(err => console.log(err));
        }
    },

    computed:{
        
    }
}
</script>


<style scoped>
.edit-button{
    float: right;
}
</style>
