<template>
<div class="home">

    <!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Staff Attendance for {{makedate}}</h3>
	</div>
	<div class="panel-body">
		<div class="row">
            <div class="showCreateAttendance" v-if="showCreateAttendance">
                            <!-- Form  -->
                            <form @submit.prevent="makeDate()">
                               <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="date">Date </label>
                                            <input type="date" id="date" v-model="makedate" name="date" max="3000-12-31" min="1000-01-01" class="form-control" style="width:200px;">
                                            <p class="text-muted">Please double Check the Date</p>
                                       </div>
                                       <div class="form-group col-md-4">
                                            <label for="eid">Employee ID</label>
                                            <input type="text" style="width: 200px;" id="eid" v-model="eid" name="eid" class="form-control">
                                            <p class="text-muted">Enter Your Employee Id</p>
                                       </div>
                               </div>
                               <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                           </div>

                           <div class="showNew" v-if="showCreateAttendance === false">

                                <input type="text" class="form-control col-md-4 mb-3" style="text-transform:uppercase;margin-botom:20px;" placeholder="Search with Employee Id" v-model="search">
                                <table class="table">
                                   <tbody>
                                       <tr>
                                       <th>#EID</th>
                                       <th>Name</th>
                                       <th>Status</th>
                                   </tr>
                                       <tr v-for="Staff in searchStaffs" v-bind:key="Staff.id">
                                           <td>{{ Staff.eid }}</td>
                                           <td>{{ Staff.name }}</td>
                                           <td>{{getStaffStatus(Staff)}}</td>
                                            
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
            makedate:'',
            eid:'',
            showCreateAttendance:true,
            Staffs:[],
            search:'',
            Attendances:[],
            
        StatusSelected:'',
            setStatuses: [
        { text: "Not Updated", value: "null" },
        { text: "Present", value: "present" },
        { text: "CL", value: "cl" },
        { text: "CPL", value: "cpl" },
        { text: "Present-Permission", value: "present-permission" },
        { text: "Present-Late", value: "present-late" },
        { text: "OD", value: "od" },
        { text: "SOD", value: "sod" },
        { text: "Absent", value: "absent" }
      ],
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
    Staff-Attendance-${this.makedate}
    `
    );
        },

        getStaffStatus(staff) {
      var status;
      var aData;
      var child;
      aData = this.Attendances;
      for (var child in aData) {
        if (aData[child].staff_id === staff.id) {
          status = aData[child].status;
        }
      }
      if (status) {
        return status;
      } else {
        return null;
      }
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
        makeDate(){
             let Formdata = {
                    makedate : this.makedate,
                    eid : this.eid,
                }
                fetch('/api/staff/attendance/date', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {
                    console.log(data);

                    this.showCreateAttendance = false;

                }).catch(err => {
                    
                });
                this.getAllAttendances();
        },
        getAllAttendances(){
            let Formdata = {
                    makedate : this.makedate
                }
                 fetch('/api/staff/attendance/getdate', {
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

                }).catch(err => {
                    
                });
        },
        makAtforStaff(Staff){
             let Formdata = {
                    makedate : this.makedate,
                    eid : this.eid,
                    staff_id: Staff.id,
                    status:this.StatusSelected,
                }
                 fetch('/api/staff/attendance/individual', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {
                    console.log(data);

                    this.StatusSelected = '';

                }).catch(err => {
                    
                });
                this.getAllAttendances();
               
        },
         setAllStaffAt(){
            let Formdata = {
                    makedate : this.makedate,
                    eid : this.eid,
                    staffs:this.Staffs,
                    status:'present'
                }
                fetch('/api/staff/attendance/allat', {
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
                    
                               
                }).catch(err => {
                    
                });
                this.getAllAttendances();
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
        searchStaffs: function() {
      let Staffs = this.Staffs;
      let search = this.search;
      if(this.search === ""){
        return Staffs;
      }else{
        return Staffs.filter(function(staff) {
        return (staff.name.toLowerCase().indexOf(search.toLowerCase()) && staff.eid.toLowerCase().indexOf(search.toLowerCase())) >= 0;
      });
      }
    }
    }
}
</script>
