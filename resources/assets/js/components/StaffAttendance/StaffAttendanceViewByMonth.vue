<template>
<div class="home">

    <!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Staff Attendance View By Month</h3>

        
	</div>
	<div class="panel-body">
        <div class="row" v-if="hideForm">
        <form @submit.prevent="getAttendances()">
		<div class="row">
              <div class="form-group col-md-4">
            <label for="fromdate">Fromdate </label>
            <input type="date" id="fromdate" v-model="fromdate" name="fromdate" max="3000-12-31" min="1000-01-01" class="form-control" style="width:200px;">
        </div>
        <div class="form-group col-md-4">
            <label for="todate">todate </label>
            <input type="date" id="todate" v-model="todate" name="todate" max="3000-12-31" min="1000-01-01" class="form-control" style="width:200px;">
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
		</div>
        </form>
	</div>
    <div class="row" v-if="hideForm === false">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                    <th>#Emp ID</th>
                    <th>Name</th>
                    <th v-for="AtDate in AtDates" v-bind:key="AtDate.id">{{AtDate.date}}</th>
                </tr>
                    <tr v-for="Staff in Staffs" v-bind:key="Staff.id">
                        <td>{{Staff.eid}}</td>
                        <td>{{Staff.name}}</td>
                        <td v-for="AtDate in AtDates" v-bind:key="AtDate.id">
                            {{getStaffAttendance(Staff,AtDate)}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary" @click="getCsv()">download</button>
        </div>
        <a class="btn btn-primary back-btn" href="">Back</a>
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
            fromdate:'',
            todate:'',
            AtRecords:[],
            AtDates:[],
           
        }
    },
          props:['authenticateduser', 'authrole'],
    mounted(){
       this.getAllStaffs();
    },
    methods:{
         getCsv(){
            var html = document.querySelector("table").outerHTML;
    this.export_table_to_csv(html, `
    Staff-Attendance-${this.fromdate}-to-${this.todate}
    `
    );
        },
        getAllStaffs(){
            fetch('/api/staffs')
            .then(res => {
                return res.json();
            })
            .then(data => {
                this.Staffs = data;
            }).catch(err => console.log(err));
        },

        getAttendances(){
             let Formdata = {
                    fromdate : this.fromdate,
                    todate : this.todate,
                }
                fetch('/api/staff/attendance/withdates', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {
                    console.log(data);

                    this.AtRecords = data['records'];
                    this.AtDates = data['dates'];
                    this.hideForm = false;

                }).catch(err => {
                    
                });
        },

                getStaffAttendance(Staff,AtDate){
            var status = [];
            var aData;
            var child;
      aData = this.AtRecords;
      for (var child in aData) {
        if (aData[child].staff_id === Staff.id && aData[child].date === AtDate.date) {
          status = aData[child].status;
        }
      }
      if (status) {
        return status;
      } else {
        return null;
      }
            
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

      
    }
}
</script>


<style scoped>

</style>
