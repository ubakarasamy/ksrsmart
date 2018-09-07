<template>
<div class="home">

    <!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Student Attendance Make</h3>
	</div>
	<div class="panel-body">
		<div class="row">
            <div class="form-create" v-if="showForm">
            <form @submit.prevent="createDateandHour()">
            <div class="col-sm-2">
                <label for="degree" class="">Degree</label>
            <select required="true" v-model="degree" class="form-control" id="degree" name="degree">
                <option selected >Choose</option>
				<option v-for="degree_option in degree_options" v-bind:key="degree_option.value">{{degree_option.text}}</option>
			</select>
            <br>
            </div>
            
            <div class="col-sm-2">
                <label for="department" class="">Department</label>
			<select required="true" v-model="department" class="form-control" id="department" name="department">
            <option selected >Choose</option>
				<option v-for="department_option in department_options" v-bind:key="department_option.value">{{department_option.text}}</option>
			</select>
            <br>
            </div>
            
            <div class="col-sm-2">
                <label for="year" class="">Year</label>
			<select required="true" v-model="year" class="form-control" id="year" name="year">
            <option selected >Choose</option>
				<option v-for="year_option in year_options" v-bind:key="year_option.value">{{year_option.text}}</option>
			</select>
            <br>
            </div>
            
            <div class="col-sm-2">
                <label for="semester" class="">Semester</label>
			<select required="true" v-model="semester" class="form-control" id="semester" name="semester">
            <option selected >Choose</option>
				<option v-for="semester_option in semester_options" v-bind:key="semester_option.value">{{semester_option.text}}</option>
			</select>
            <br>
            </div>
            
            <div class="col-sm-2">
                <label for="section" class="">Section</label>
			<select required="true" v-model="section" class="form-control" id="section" name="section">
            <option selected >Choose</option>
				<option v-for="section_option in section_options" v-bind:key="section_option.value">{{section_option.text}}</option>
			</select>
            <br>
            </div>
            
            <div class="col-sm-2">
                <label for="day" class="">Day</label>
			<select required="true" v-model="day" class="form-control" id="day" name="day">
            <option selected >Choose</option>
				<option v-for="day_option in day_options" v-bind:key="day_option.value">{{day_option.text}}</option>
			</select>
            <br>
            </div>
            <div class="col-sm-2">
                <label for="hour" class="">Hour</label>
			<select required="true" v-model="hour" class="form-control" id="hour" name="hour">
            <option selected >Choose</option>
				<option v-for="hour_option in hour_options" v-bind:key="hour_option.value">{{hour_option.text}}</option>
			</select>
            <br>
            </div>
            <div class="col-sm-2">
                <br>
                <br>
                <p>{{displaySubject()}}</p>
            </div>
            <div class="col-sm-2">
                <label for="date">Date </label>
                <input required="true" type="date" id="date" v-model="date" name="date" max="3000-12-31" min="1000-01-01" class="form-control">
            </div>
            <div class="col-sm-6">
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <br><br>
                <p class="text-muted">By clicking submit this hour is added as working hours</p>
            </div>
            
            </form>	
            </div>	
            <div class="create-attendance" v-if="showForm === false">

<a class="btn btn-primary back-btn" href="">Back</a>

                <button @click="createAllStudentHour()" class="btn btn-primary">All present</button>

                <table class="table">
                    <thead>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Change Status</th>
                    </thead>
                    <tbody>
<tr v-for="student in filteredStudents" v-bind:key="student.id">
                            <td>{{student.reg_no}}</td>
                            <td>{{student.name}}</td>
                            <td>{{getStudentStatus(student)}}</td>
                            <td>
<select class="form-control" @change="createStudentHour(student)" v-model="Sstatus"> 
  <option  v-for="atStatus in atStatuses" >
    {{ atStatus.text }}
  </option>
</select>
<span></span>
                            </td>
                        </tr>
                    </tbody>
                </table>

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
            
            Studs:[],
            showForm:true,
            Schedules:[],
            schedule_id:'',
            date:'',
            student_attendance_id:'',
            is_sheduled_staff:'',
            alternate_staff:'',

            Attendances:[],
            
            Sstatus:'',
            atStatuses:[
                {text:'Present', value:'present'},
                {text:'Absent', value:'absent'},
                {text:'Leave', value:'leave'},
                {text:'OD', value:'od'}
            ],
            hour:'',
            hour_options:[
                {text:'1',value:'1'},
                {text:'2',value:'2'},
                {text:'3',value:'3'},
                {text:'4',value:'4'},
                {text:'5',value:'5'},
                {text:'6',value:'6'},
                {text:'7',value:'7'}
            ],
            day:'',
            day_options:[
                {text:'Mon',value:'mon'},
                {text:'Tue',value:'tue'},
                {text:'Wed',value:'wed'},
                {text:'Thu',value:'thu'},
                {text:'Fri',value:'fri'}
            ],
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
                    {text:'AUTO', value:'auto'},
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
                    {text:'b', value:'b'},
                    {text:'c', value:'c'}
                ]
        }
    },
    mounted(){
        this.getAllShedules();
        this.getAllStudents();
    },
     props:['authenticateduser'],
    methods:{

getStudentStatus(student) {
      var status;
      var aData;
      var child;
      aData = this.Attendances;
      for (var child in aData) {
        if (aData[child].student_id === student.id) {
          status = aData[child].status;
        }
      }
      if (status) {
        return status;
      } else {
        return null;
      }
    },


// GET ALL STUDENTS
        getAllStudents(){
            fetch('/api/students')
            .then(res => {
                return res.json();
            })
            .then(data => {
                this.Studs = data;
            }).catch(err => console.log(err));
        },

// DISPLAY SUBJECT IN FRONT
        displaySubject(){
        let degree = this.degree.toLowerCase();
        let department = this.department.toLowerCase();
        let year = this.year;
        let semester = this.semester;
        let section = this.section;
        let day = this.day.toLowerCase();
        let hour = this.hour;
            if(degree !== "" && department !== "" && year !== "" && semester !== "" && section !== "" && day !== "" && hour !== ""){
                this.schedule_id = this.filterSchedules[0].id;
console.log(this.authenticateduser.id);
console.log(this.filterSchedules[0].staff_id);

                if(this.authenticateduser.id !== this.filterSchedules[0].staff_id){
                    this.is_sheduled_staff = false;
                    this.alternate_staff = this.authenticateduser.id;
                }else{
                    this.is_sheduled_staff = true;
                    this.alternate_staff = null;
                }

                return `${this.filterSchedules[0].subject_name}`;
            }else{
                return '__';
            }
        },
// GET ALL SCHEDULES
        getAllShedules(){
            fetch('/api/schedule/show')
            .then(res => { return res.json(); })
                .then(data => {
                    this.Schedules = data;
                    // console.log(data);
                }).catch(err => console.log(err));
        },

// CREATE DATE AND HOUR FOR GETTING OVERALL
        createDateandHour(){
            let Formdata = {
                    degree : this.degree.toLowerCase(),
                    department : this.department.toLowerCase(),
                    year : Number(this.year),
                    semester : Number(this.semester),
                    section : this.section,

                    schedule_id:this.schedule_id,
                    date : this.date,
                    hour : this.hour,
                    is_sheduled_staff : this.is_sheduled_staff,
                    alternate_staff : this.alternate_staff
                }
                fetch('/api/student/attendance/dateandhour', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {
                    console.log(data);
this.Attendances = data;
                        this.showForm = false;
                    
                }).catch(err => {
                    
                });
        },
// CREATE HOUR ATTENDANCE 
        createStudentHour(student){
            let Formdata = {
                    degree : this.degree.toLowerCase(),
                    department : this.department.toLowerCase(),
                    year : Number(this.year),
                    semester : Number(this.semester),
                    section : this.section,
                    student_id:student.id,
                    
                    schedule_id:this.schedule_id,
                    date : this.date,
                    hour : this.hour,
                    status : this.Sstatus.toLowerCase()
                    
                }
                fetch('/api/student/attendance/hour', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {
                    console.log(data);

                    this.Sstatus='';
                    
                    this.Attendances = data;
                    
                }).catch(err => {
                    
                });
        },
         createAllStudentHour(){
            let Formdata = {
                    degree : this.degree.toLowerCase(),
                    department : this.department.toLowerCase(),
                    year : Number(this.year),
                    semester : Number(this.semester),
                    section : this.section,
                    students:this.filteredStudents,
                    
                    schedule_id:this.schedule_id,
                    date : this.date,
                    hour : this.hour,
                    status : 'present'
                    
                }
                fetch('/api/student/attendance/hour/all', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {
                    console.log(data);

                    this.getAllStudents();
                        this.Attendances = data;
                    
                }).catch(err => {
                    
                });
        },







        
        
    },

    computed:{
        filterSchedules(){
        let Schedules = this.Schedules;
        let degree = this.degree.toLowerCase();
        let department = this.department.toLowerCase();
        let year = this.year;
        let semester = this.semester;
        let section = this.section;
        let day = this.day.toLowerCase();
        let hour = this.hour;
       
        if (degree === "" && department === "" && year === "" && semester === "" && section === "" && day === "" && hour === "") {
            return Schedules;
        }else{
            return Schedules.filter(function(Schedule){
                return (
                    (degree === "" || degree === Schedule.degree)
                    && (department === "" || department === Schedule.department)
                    && (year === "" || Number(year) === Schedule.year)
                    && (semester === "" || Number(semester) === Schedule.semester)
                    && (section === "" || section === Schedule.section)
                    && (day === "" || day === Schedule.day)
                    && (hour === "" || Number(hour) === Schedule.hour)
                    );
            })
        }

    },

    filteredStudents(){
 
        let vm = this;
        let department = vm.department.toLowerCase();
        let year = vm.year;
        let semester = vm.semester;
        let section = vm.section;
        let degree = vm.degree.toLowerCase();
        
        if(department === '' && year === '' && section === '' && degree === '' && semester === ''){
          return vm.Studs;
        }else{
          return vm.Studs.filter(function(student){
            return (department === '' || student.department === department) 
            && (year === '' || student.year === Number(year)) 
            && (section === '' || student.section === section) 
            && (degree === '' || student.degree === degree)
            && (semester === '' || student.semester === Number(semester))
            ;
          });
          }
        },
    }
}
</script>
