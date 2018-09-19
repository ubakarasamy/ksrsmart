<template>
<div class="home">

<!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Student Attendance View By Subject </h3>
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

            <div class="form-group col-sm-2"> 
                <label for="Subject">Subject</label>
                <select class="form-control" name="Subject" id="Subject" @change="getSubjectId()" v-model="Subject_selected">
                    <option v-for="Subject in filterSubjects">{{Subject.subject_name}}</option>
                </select><br>
            </div>

        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
	</div>
    <div class="row" v-if="hideForm === false">
        <div class="back-btn-div">
                <a class="btn btn-primary back-btn" href="">Back</a>
            </div>
        <div class="table-responsive">
            <table class="table">
                
                <tbody>
                    <tr>
                    <th>REG No</th>
                    <th>Name</th>
                    <th>Hours</th>
                    <th>Percentage</th>
                </tr>
                    <tr v-for="Student in filteredStudents" v-bind:key="Student.id">
                        <td>{{Student.reg_no}}</td>
                        <td>{{Student.name}}</td>
                        <td>{{getStudSubOverall(Student)}} / {{Totalhours()}}</td>
                        <td>{{attendancePercentage(Student)}}</td>
                    </tr>
                </tbody>
            </table>

            <button class="btn btn-primary" @click="getCsv()">download</button>
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
            subject_id:'',
            Subject_selected:'',
            Subjects:[],
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
     props:['authenticateduser', 'authrole'],
    mounted(){
        this.getAllStudents();
        this.getAllSubjects();
    },
    methods:{
         getCsv(){
            var html = document.querySelector("table").outerHTML;
    this.export_table_to_csv(html, `
    ${this.degree}-${this.department}-${this.year}-${this.section}-${this.Subject_selected}
    `
    );
         },
        Totalhours(){
            return this.AtHours.length;
        },
        attendancePercentage(Student){

 this.AtHours;
 var status = [];
 var stat;
            var aData;
            var child;
            let Fletters;
      aData = this.AtRecords;
      for (var child in aData) {
        if (aData[child].student_id === Student.id) {
          status.push(aData[child]);
        }
      }
      if (status) { 
          stat = (status.length / this.AtHours.length) * 100;
          return Math.round(stat);
      } else {
        return "null";
      }
    },


        getSubjectId(){
            var subb;
            var staff;
                var Subs;
     
                Subs = this.filterSubjects;
                for(var child in Subs){
                    if (Subs[child].subject_name === this.Subject_selected){
                        subb = Subs[child].id;
                        staff = Subs[child].staff_id;

                        this.subject_id = subb;
                    }
                }
               
        },

  getAllSubjects(){
                fetch('/api/schedule/subject/show')
                .then(res => { return res.json(); })
                .then(data => {
                    this.Subjects = data;
                }).catch(err => console.log(err));
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

 getStudSubOverall(Student){
            var status = [];
            var aData;
            var child;
      aData = this.AtRecords;
      for (var child in aData) {
        if (aData[child].student_id === Student.id) {
          status.push(aData[child].status);
        }
      }
      if (status) {

        return status.length;
      } else {
        return "null";
      }
},
       
        getAttendances(){
            let Formdata = {
                    subject_id:this.subject_id,
                    degree:this.degree.toLowerCase(),
                    department:this.department.toLowerCase(),
                    year:this.year,
                    semester:this.semester,
                    section:this.section
                }

            fetch('/api/student/attendance/view/bysubject', {
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
                    this.AtHours = data['total_hours'];
                    this.AtRecords = data['records'];                 
             
                    
                }).catch(err => {
                    
                });
        },
  download_csv(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
},

export_table_to_csv(html, filename) {
	var csv = [];
	var rows = document.querySelectorAll("table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV
    this.download_csv(csv.join("\n"), filename);
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

    
    filterSubjects(){
        let Subjects = this.Subjects;
        let degree = this.degree.toLowerCase();
        let department = this.department.toLowerCase();
        let year = this.year;
        let semester = this.semester;
        let section = this.section;

        if (degree === "" && department === "" && year === "" && semester === "" && section === "") {
            return Subjects;
        }else{
            return Subjects.filter(function(subject){
                return (
                    (degree === "" || degree === subject.degree)
                    && (department === "" || department === subject.department)
                    && (year === "" || Number(year) === subject.year)
                    && (semester === "" || Number(semester) === subject.semester)
                    && (section === "" || section === subject.section)
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
}

.hover-blk:hover .hover-text{
    display:block;
}
</style>
