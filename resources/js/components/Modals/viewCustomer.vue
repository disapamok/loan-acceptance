<template>
    <div class="modal" tabindex="-1" role="dialog" id="customerDetails">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{customerData.name}}'s loan details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-data-showcase">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="text-bold">Customer Name</label>
                                <p>{{customerData.name}}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="text-bold">Total Due</label>
                                <p>{{customerData.total_due}}</p>
                            </div>
                        </div>
                    </div>
                    <h5>Ongoing Loans</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Loan Number</th>
                                <th class="text-right">Loan Amount</th>
                                <th class="text-right">Loan Duration</th>
                                <th class="text-right">Bank File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="loan in customerData.loans" :key="loan.id">
                                <td>LOAN0{{loan.id}}</td>
                                <td class="text-right">{{loan.pretty_amount}} LKR</td>
                                <td class="text-right">{{loan.duration}} Months</td>
                                <td class="text-right"><a :href="'/loans/download/'+loan.id">Download</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            customerData : []
        }
    },
    methods : {
        modelOpened : function (customerID){
            axios.get('/customers/get/'+customerID).then(response => {
                this.customerData = response.data.data.customer;
            }).catch(function (){
                alert('Something went wrong');
            });
        }
    },
    mounted (){
        $("#customerDetails").on("show.bs.modal", function (){
            this.customerData = [];
        });
    }
}
</script>

</script>
