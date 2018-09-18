<template>
    <div class="home">
        <div class="panel panel-headine">
            <div class="panel-heading">
                <h3 class="panel-title">Staff Approvals</h3>
            </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Approval For</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for="AllApproval in AllApprovals" v-bind:key="AllApproval.id">
                        <td>{{getMyEid(AllApproval)}}</td>
                        <td>{{getMyName(AllApproval)}}</td>
                        <td>{{AllApproval.approval_for}}</td>
                        <td>
                            <button class="btn btn-success" @click="updateApproval('approved',AllApproval.id)">Approve</button>
                            <button class="btn btn-danger" @click="updateApproval('disapproved',AllApproval.id)">DisApprove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h3 style="text-align:center;" v-if="Zero">{{Zero}}</h3>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            Zero:'',
            AllApprovals:[],
            AllStaffs:[],

        }
    },
    mounted(){
        this.getAllApprovals();
        this.getAllStaffs();
    },

    props:['authenticateduser'],

    methods:{

            getAllStaffs(){
            fetch('/api/staffs')
            .then(res => {
                return res.json();
            })
            .then(data => {
                this.AllStaffs = data;
            }).catch(err => console.log(err));
        },
        getAllApprovals(){
            fetch('/api/staff/approval/getallapprovals')
            .then(res => {
                return res.json();
            })
            .then(data => {
                this.AllApprovals = data;
                 if(this.AllApprovals.length < 1){
                this.Zero = 'No approvals Found!';
            }
            }).catch(err => console.log(err));
        },



        getMyEid(AllApproval){
               var status;
      var aData;
      var child;
      aData = this.AllStaffs;
      for (var child in aData) {
        if (aData[child].id === AllApproval.staff_id) {
          status = aData[child].eid;
        }
      }
      if (status) {
        return status;
      } else {
        return null;
      }
        },
          getMyName(AllApproval){
               var status;
      var aData;
      var child;
      aData = this.AllStaffs;
      for (var child in aData) {
        if (aData[child].id === AllApproval.staff_id) {
          status = aData[child].name;
        }
      }
      if (status) {
        return status;
      } else {
        return null;
      }
        },

        updateApproval(stat,a_id){
            let Formdata = {
                approval_id: a_id,
                approved_by: this.authenticateduser.id,
                status: stat
            }
            fetch('/api/staff/approval/getmyapprovals', {
                method: "put",
                body: JSON.stringify(Formdata),
                headers: {
                    "content-type": "application/json"
                }
            }).then(res => { 
                return res.json();
                 
            }).then(data => {
                console.log(data);
                this.getAllApprovals();
            }).catch(err => console.log(err));
            this.zeroMessage();
        }
       
    },

    

    computed:{
        
    }
}
</script>
