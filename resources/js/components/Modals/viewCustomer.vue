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

                    <div v-if="loading == true && customerData.loans.length > 0">
                        <h6><b>Ongoing Loans</b></h6>
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

                    <div v-for="loan in customerData.loans" :key="'schedule'+loan.id">
                        <h6><b>Re-payment schedule for: LOAN0{{loan.id}} </b></h6>
                        <table class="table">
                            <tr>
                                <th>Instalment Number</th>
                                <th>Month</th>
                                <th class="text-right">Amount</th>
                                <th class="text-right">Status</th>
                            </tr>
                            <tr v-for="schedule in loan.schedule" :key="'SCH'+schedule.id">
                                <td>INST0{{schedule.id}}</td>
                                <td>{{schedule.due_date}}</td>
                                <td class="text-right">{{schedule.pretty_amount}} LKR</td>
                                <td class="text-right">{{schedule.paid_at == null ? 'Not Settled' : 'Settled'}}</td>
                            </tr>
                        </table>

                    </div>

                    <div v-if="loading == true && customerData.loans.length == 0">
                        <p class="text-center">There is no ongoing loan for this customer.</p>
                    </div>
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
            customerData : [],
            loading : false
        }
    },
    methods : {
        modelOpened : function (customerID){
            axios.get('/customers/get/'+customerID).then(response => {
                this.customerData = response.data.data.customer;
                this.loading = true;
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
