<template>
<div class="home">

    <!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Staff Attendance View Overall</h3>

        <p>These Results are calculated from {{Yrstart}} to today</p>
	</div>
	<div class="panel-body">
       
    <div class="row">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>#Emp ID</th>
                    <th>Name</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>CL</th>
                    <th>CPL</th>
                    <th>OD</th>
                    <th>SOD</th>
                </thead>
                <tbody>
                    <tr v-for="Staff in Staffs" v-bind:key="Staff.id">
                        <td>{{Staff.eid}}</td>
                        <td>{{Staff.name}}</td>
                        <td>{{getStaffAttendance(Staff,'present')}}</td>
                        <td>{{getStaffAttendance(Staff,'absent')}}</td>
                        <td>{{getStaffAttendance(Staff,'cl')}}</td>
                        <td>{{getStaffAttendance(Staff,'cpl')}}</td>
                        <td>{{getStaffAttendance(Staff,'od')}}</td>
                        <td>{{getStaffAttendance(Staff,'sod')}}</td>
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
            hideForm:true,
            Staffs:[],
            AtRecords:[],
            AtDates:[],
           
        }
    },
    mounted(){
       this.getAllStaffs();
       this.getAllAttendances();
    },
    methods:{
        getAllStaffs(){
            fetch('/api/staffs')
            .then(res => {
                return res.json();
            })
            .then(data => {
                this.Staffs = data;
            }).catch(err => console.log(err));
        },

        getAllAttendances(){
            fetch('/api/staffs/attendances')
            .then(res => {
                return res.json();
            })
            .then(data => {
                console.log(data);
                this.Yrstart = data['year_start'];
                this.AtRecords = data['records'];
                this.AtDates = data['dates'];
            }).catch(err => console.log(err));
        },

                getStaffAttendance(Staff,stat){
            var status = [];
            var aData;
            var child;
      aData = this.AtRecords;
      for (var child in aData) {
        if (aData[child].staff_id === Staff.id && aData[child].status === stat) {
          status.push(aData[child].status);
        }
      }
      if (status) {
        return status.length;
      } else {
        return null;
      }
        },
      
    },

    computed:{

      
    }
}
</script>


<style scoped>

</style>
