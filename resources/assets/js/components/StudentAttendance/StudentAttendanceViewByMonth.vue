<template>
<div class="home">

    <!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Student Attendance View By Month</h3>

	</div>
	<div class="panel-body">
        <div class="row" v-if="hideForm">
            <a class="btn btn-primary back-btn" href="">Back</a>
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
                <label for="fromdate">From date</label>
                <input required="true" type="date" id="fromdate" v-model="fromdate" name="fromdate" max="3000-12-31" min="1000-01-01" class="form-control">
            </div>
            <div class="col-sm-2">
                <label for="todate">To date</label>
                <input required="true" type="date" id="todate" v-model="todate" name="todate" max="3000-12-31" min="1000-01-01" class="form-control">
            </div>
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
	</div>
    <div class="row" v-if="hideForm === false">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Student REG No</th>
                    <th>Name</th>
                    <th v-for="AtDate in AtDates" v-bind:key="AtDate.id">
                        {{AtDate.date}}
                    </th>
                </thead>
                <tbody>
                    <tr v-for="Student in filteredStudents" v-bind:key="Student.id">
                        <td>{{Student.reg_no}}</td>
                        <td>{{Student.name}}</td>
                        <td v-for="AtDate in AtDates" v-bind:key="AtDate.id">
                            {{getAttendance(Student,AtDate)}} / {{AtDate.total_hours}}
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

            AtRecords:[],
            AtDates:[],
            hideForm:true,
            fromdate:'',
            todate:'',
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
                    {text:'b', value:'a'},
                    {text:'c', value:'c'}
                ]
        }
    },
     props:['authenticateduser'],
    mounted(){
        this.getAllStudents();
    },
    methods:{

        getAttendance(Student,AtDate){
            var status = [];
            var aData;
            var child;
      aData = this.AtRecords;
      for (var child in aData) {
        if (aData[child].student_id === Student.id && aData[child].date === AtDate.date && aData[child].is_present === 1) {
          status.push(aData[child]);
        }
      }
      if (status) {
        return status.length;
      } else {
        return null;
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

        getAttendances(){
            let Formdata = {
                    fromdate:this.fromdate,
                    todate:this.todate,
                    degree:this.degree.toLowerCase(),
                    department:this.department.toLowerCase(),
                    year:this.year,
                    semester:this.semester,
                    section:this.section
                }
                
                fetch('/api/student/attendance/view/bydate', {
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

                   this.AtDates = data['dates'];
                   this.AtRecords = data['records'];
                    
                }).catch(err => {
                    
                });
        }
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
    }
}
</script>
