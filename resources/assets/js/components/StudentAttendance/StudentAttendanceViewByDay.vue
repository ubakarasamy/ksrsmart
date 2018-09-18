<template>
<div class="home">

    <!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Student Attendance View By Date</h3>

        
	</div>
	<div class="panel-body">
        <div class="row" v-if="hideForm">
        <form @submit.prevent="getAttendances()">
		<div class="row">
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
                <label for="date">From date</label>
                <input required="true" type="date" id="date" v-model="date" name="date" max="3000-12-31" min="1000-01-01" class="form-control">
            </div>
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
	</div>
    <div class="row" v-if="hideForm === false">

        <a class="btn btn-primary back-btn" href="">Back</a>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Student REG No</th>
                    <th>Name</th>
                    <th class="hover-blk">
                        1) {{getSchedule(this.filterSchedules[0].day,1).cap}}
                        <span class="hover-text"> {{getSchedule(this.filterSchedules[0].day,1).subject}}</span>
                    </th>
                    <th class="hover-blk">
                        2) {{getSchedule(this.filterSchedules[0].day,2).cap}}
                        <span class="hover-text"> {{getSchedule(this.filterSchedules[0].day,2).subject}}</span>
                    </th>
                    <th class="hover-blk">
                        3) {{getSchedule(this.filterSchedules[0].day,3).cap}}
                        <span class="hover-text"> {{getSchedule(this.filterSchedules[0].day,3).subject}}</span>
                    </th>
                    <th class="hover-blk">
                        4) {{getSchedule(this.filterSchedules[0].day,4).cap}}
                        <span class="hover-text"> {{getSchedule(this.filterSchedules[0].day,4).subject}}</span>
                    </th>
                    <th class="hover-blk">
                        5) {{getSchedule(this.filterSchedules[0].day,5).cap}}
                        <span class="hover-text"> {{getSchedule(this.filterSchedules[0].day,5).subject}}</span>
                    </th>
                    <th class="hover-blk">
                        6) {{getSchedule(this.filterSchedules[0].day,6).cap}}
                        <span class="hover-text"> {{getSchedule(this.filterSchedules[0].day,6).subject}}</span>
                    </th>
                    <th class="hover-blk">
                        7) {{getSchedule(this.filterSchedules[0].day,7).cap}}
                        <span class="hover-text"> {{getSchedule(this.filterSchedules[0].day,7).subject}}</span>
                    </th>
                </thead>
                <tbody>
                    <tr v-for="Student in filteredStudents" v-bind:key="Student.id">
                        <td>{{Student.reg_no}}</td>
                        <td>{{Student.name}}</td>
                        <td>
                            {{getAttendance(Student,1)}} 
                        </td>
                        <td>
                            {{getAttendance(Student,2)}} 
                        </td>
                        <td>
                            {{getAttendance(Student,3)}} 
                        </td>
                        <td>
                            {{getAttendance(Student,4)}} 
                        </td>
                        <td>
                            {{getAttendance(Student,5)}} 
                        </td>
                        <td>
                            {{getAttendance(Student,6)}} 
                        </td>
                        <td>
                            {{getAttendance(Student,7)}} 
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
        return{

            Studs:[],


            Schedules:[],
            AtRecords:[],
            AtHours:[],
            hideForm:true,
            date:'',
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
     props:['authenticateduser'],
    mounted(){
        this.getAllStudents();
        this.getAllShedules();
    },
    methods:{

        getAttendance(Student,AtHour){
            var status = [];
            var aData;
            var child;
            let Fletters;
      aData = this.AtRecords;
      for (var child in aData) {
        if (aData[child].student_id === Student.id && aData[child].date === this.date && aData[child].hour === AtHour) {
          status = aData[child].status;
        }
      }
      if (status) {
        return status;
      } else {
        return "null";
      }
},

        getAllStudents(){
            fetch('/api/students')
            .then(res => {
                return res.json();
            })
            .then(data => {
                this.Studs = data;
            }).catch(err => console.log(err));
        },

        getSchedule(day,hour){
                var sche;
                var Schedules;
    
                Schedules = this.filterSchedules;
                for(var child in Schedules){
                    if (Schedules[child].day === day && Schedules[child].hour === hour){
                        sche = Schedules[child].subject_name;
                    }
                }
                if(sche){
                    var abbr = String(sche).split(' ').map(function(item){return item[0]}).join('');
                    return {'subject':sche, 'cap':abbr};
                }else{
                    return '__';
                }
            },

        getAttendances(){
            let Formdata = {
                    date:this.date,
                    degree:this.degree.toLowerCase(),
                    department:this.department.toLowerCase(),
                    year:this.year,
                    semester:this.semester,
                    section:this.section
                }
                
                fetch('/api/student/attendance/view/byday', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {

                    this.hideForm = false;
                    console.log(data);

                   this.AtHours = data['hours'];
                   this.AtRecords = data['records'];
                    
                }).catch(err => {
                    
                });
        },

        getAllShedules(){
            fetch('/api/schedule/show')
            .then(res => { return res.json(); })
                .then(data => {
                    this.Schedules = data;
                    // console.log(data);
                }).catch(err => console.log(err));
        },
    },

    computed:{

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

        filterSchedules(){
        let Schedules = this.Schedules;
        let degree = this.degree.toLowerCase();
        let department = this.department.toLowerCase();
        let year = this.year;
        let semester = this.semester;
        let section = this.section;

        if (degree === "" && department === "" && year === "" && semester === "" && section === "") {
            return Schedules;
        }else{
            return Schedules.filter(function(Schedule){
                return (
                    (degree === "" || degree === Schedule.degree)
                    && (department === "" || department === Schedule.department)
                    && (year === "" || Number(year) === Schedule.year)
                    && (semester === "" || Number(semester) === Schedule.semester)
                    && (section === "" || section === Schedule.section)
                    );
            })
        }

    }
    }
}
</script>


<style scoped>
.hover-text{
    display:none;
    transition: all ease-in .2s;
    position: absolute;
    margin-top: -50px;
}

.hover-blk:hover .hover-text{
    display:block;
}
</style>
