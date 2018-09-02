<template>
<div class="home">

    <!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Assign Schedule</h3>
	</div>
	<div class="panel-body">
		<div class="row">
            <form @submit.prevent="assignSchedule()">
            <div class="select-class"  v-if="SelectionBar === true">
                <div class="row">
                    <div class="form-group col-sm-2">
                        <label for="degree" class="">Degree</label>
            <select v-model="degree" class="form-control" id="degree" name="degree">
                <option selected disabled>Choose</option>
				<option v-for="degree_option in degree_options" v-bind:key="degree_option.value">{{degree_option.value}}</option>
			</select>
            <br>
             </div>
                    <div class="form-group col-sm-2"> 
            <label for="department" class="">Department</label>
			<select v-model="department" class="form-control" id="department" name="department">
            <option selected disabled>Choose</option>
				<option v-for="department_option in department_options" v-bind:key="department_option.value">{{department_option.value}}</option>
			</select>
            <br>
             </div>
                    <div class="form-group col-sm-2"> 
                        <label for="year" class="">Year</label>
            <select v-model="year" class="form-control" id="year" name="year">
            <option selected disabled>Choose</option>
				<option v-for="year_option in year_options" v-bind:key="year_option.value">{{year_option.text}}</option>
			</select>
            <br>
             </div>
                    <div class="form-group col-sm-2"> 
            <label for="semester" class="">Semester</label>
			<select v-model="semester" class="form-control" id="semester" name="semester">
            <option selected disabled>Choose</option>
				<option v-for="semester_option in semester_options" v-bind:key="semester_option.value">{{semester_option.value}}</option>
			</select>
            <br>
             </div>
                    <div class="form-group col-sm-2"> 
            <label for="section" class="">Section</label>
			<select v-model="section" class="form-control" id="section" name="section">
            <option selected disabled>Choose</option>
				<option v-for="section_option in section_options" v-bind:key="section_option.value">{{section_option.text}}</option>
			</select>
            <br>
            <p class="btn btn-primary" @click="selctionSubmit()">Submit</p>
                    </div>
                    </div>
            </div>
            <div class="assign-subject" v-if="SelectionBar === false">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Day/Hour</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                        </thead>
                        <tbody>
                            <!-- <tr v-for="Day in Days"> -->
                                <!-- <td  v-for="Hour in Hours">{{getSchedule(Day.value,Hour.value)}}</td> -->
                            <tr>
                                <td>{{getSchedule('mon',1)}}</td>
                                <td>{{getSchedule('mon',2)}}</td>
                                <td>{{getSchedule('mon',3)}}</td>
                                <td>{{getSchedule('mon',4)}}</td>
                                <td>{{getSchedule('mon',5)}}</td>
                                <td>{{getSchedule('mon',6)}}</td>
                                <td>{{getSchedule('mon',7)}}</td>
                            </tr>
                            <tr>
                                <td>{{getSchedule('tue',1)}}</td>
                                <td>{{getSchedule('tue',2)}}</td>
                                <td>{{getSchedule('tue',3)}}</td>
                                <td>{{getSchedule('tue',4)}}</td>
                                <td>{{getSchedule('tue',5)}}</td>
                                <td>{{getSchedule('tue',6)}}</td>
                                <td>{{getSchedule('tue',7)}}</td>
                            </tr>
                            <tr>
                                <td>{{getSchedule('wed',1)}}</td>
                                <td>{{getSchedule('wed',2)}}</td>
                                <td>{{getSchedule('wed',3)}}</td>
                                <td>{{getSchedule('wed',4)}}</td>
                                <td>{{getSchedule('wed',5)}}</td>
                                <td>{{getSchedule('wed',6)}}</td>
                                <td>{{getSchedule('wed',7)}}</td>
                            </tr>
                            <tr>
                                <td>{{getSchedule('thu',1)}}</td>
                                <td>{{getSchedule('thu',2)}}</td>
                                <td>{{getSchedule('thu',3)}}</td>
                                <td>{{getSchedule('thu',4)}}</td>
                                <td>{{getSchedule('thu',5)}}</td>
                                <td>{{getSchedule('thu',6)}}</td>
                                <td>{{getSchedule('thu',7)}}</td>
                            </tr>
                            <tr>
                                <td>{{getSchedule('fri',1)}}</td>
                                <td>{{getSchedule('fri',2)}}</td>
                                <td>{{getSchedule('fri',3)}}</td>
                                <td>{{getSchedule('fri',4)}}</td>
                                <td>{{getSchedule('fri',5)}}</td>
                                <td>{{getSchedule('fri',6)}}</td>
                                <td>{{getSchedule('fri',7)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="frm">
                    <div class="row">
                    <div class="form-group col-sm-2"> 
                        <label for="day">Day</label>
                    <select class="form-control" name="day" id="day" v-model="Day_selected">
                        <option v-for="Day in Days">{{Day.text}}</option>
                    </select><br>
                    </div>
                    <div class="form-group col-sm-2"> 
                    <label for="hour">Hour</label>
                    <select class="form-control" name="hour" id="hour" v-model="Hour_selected">
                        <option v-for="Hour in Hours">{{Hour.text}}</option>
                    </select><br>
                    </div>
                    <div class="form-group col-sm-2"> 
                    <label for="Subject">Subject</label>
                    <select class="form-control" name="Subject" id="Subject" v-model="Subject_selected">
                        <option v-for="Subject in filterSubjects">{{Subject.subject_name}}</option>
                    </select><br>
                    </div>
                    <br>
                    <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </div>

            </form>
		</div>
	</div>
</div>

</div>







</template>


<script>
export default {
    data(){
        return {
            SelectionBar:true,


            Subject_selected:'',
            Subjects:[],
            Schedules:[],

            Hour_selected:'',
            Hours:[
                {text:'1', value:'1'},
                {text:'2', value:'2'},
                {text:'3', value:'3'},
                {text:'4', value:'4'},
                {text:'5', value:'5'},
                {text:'6', value:'6'},
                {text:'7', value:'7'}
            ],
            Day_selected:'',
            Days:[
                {text:'Mon', value:'mon'},
                {text:'Tue', value:'tue'},
                {text:'Wed', value:'wed'},
                {text:'Thu', value:'thu'},
                {text:'Fri', value:'fri'}
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
                    {text:'b', vblue:'a'},
                    {text:'c', vclue:'c'}
                ],
        }
    },
    mounted() {
        this.getAllShedules();
        this.getAllSubjects();
    },
    methods:{
        selctionSubmit(){
            this.SelectionBar=false;
        },


        assignSchedule(){

 var subb;
                var Subs;
     
                Subs = this.Subjects;

                for(var child in Subs){
                    if (Subs[child].subject_name === this.Subject_selected){
                        subb = Subs[child].id;
                    }
                }

                let Formdata = {
                    Subject_selected:subb,
                    Hour_selected:this.Hour_selected,
                    Day_selected:this.Day_selected,

                    degree:this.degree,
                    department:this.department,
                    year:this.year,
                    semester:this.semester,
                    section:this.section,
                }

                fetch('/api/schedule/store', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {
                    if(data = 'success'){
                        alert('successfully Created');
                    }else{
                        alert('Something went wrong!');
                    }
                    console.log(data);
                }).catch(err => {
                    console.log(err);
                });
                this.getAllSubjects();

            },

        getAllShedules(){

            fetch('/api/schedule/show')
            .then(res => { return res.json(); })
                .then(data => {
                    this.Schedules = data;
                    console.log(data);
                }).catch(err => console.log(err));

        },

    getAllSubjects(){
                fetch('/api/schedule/subject/show')
                .then(res => { return res.json(); })
                .then(data => {
                    this.Subjects = data;
                    console.log(data);
                }).catch(err => console.log(err));
            },

            getSchedule(day,hour){
                var sche;
                var Schedules;
     
                Schedules = this.Schedules;

                for(var child in Schedules){
                    if (Schedules[child].day === day && Schedules[child].hour === hour){
                        sche = Schedules[child].subject_name;
                    }
                }

                if(sche){
                    return sche;
                }else{
                    return '__';
                }
            }

},

computed:{
    filterSubjects(){
        let Subjects = this.Subjects;
        let degree = this.degree;
        let department = this.department;
        let year = this.year;
        let semester = this.semester;
        let section = this.section;

        if (degree === "" && department === "" && year === "" && semester === "" && section === "") {
            return Subjects;
        }else{
            return Subjects.filter(function(subject){
                return (
                    (department === "" || department === subject.department)
                    && (department === "" || department === subject.department)
                    && (year === "" || Number(year) === subject.year)
                    && (semester === "" || Number(semester) === subject.semester)
                    && (section === "" || section === subject.section)
                    );
            })
        }
    },

    filterSchedules(){
        let Schedules = this.Schedules;
        let degree = this.degree;
        let department = this.department;
        let year = this.year;
        let semester = this.semester;
        let section = this.section;

        if (degree === "" && department === "" && year === "" && semester === "" && section === "") {
            return Schedules;
        }else{
            return Schedules.filter(function(Schedule){
                return (
                    (department === "" || department === Schedule.department)
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
