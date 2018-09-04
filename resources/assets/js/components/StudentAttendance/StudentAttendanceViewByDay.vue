<template>
<div class="home">

    <!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Student Attendance View By Date</h3>
	</div>
	<div class="panel-body">
        <div class="row">
        <form>
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
                <label for="date">Date </label>
                <input required="true" type="date" id="date" v-model="date" name="date" max="3000-12-31" min="1000-01-01" class="form-control">
            </div>
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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
            AtDatas:[],

        }
    },

    methods:{
        getAllSubjects(){
                fetch('/api/schedule/subject/show')
                .then(res => { return res.json(); })
                .then(data => {
                    this.AtDatas = data;
                    console.log(data);
                }).catch(err => console.log(err));
            },
    }
}
</script>

