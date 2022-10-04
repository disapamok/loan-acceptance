<template>
    <div class="modal" tabindex="-1" role="dialog" id="addLoan">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Loan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" placeholder="Customer Name" class="form-control" v-model="addLoan.customer_name"/>
                        <p v-if="addLoanErrors.customer_name != null" class="text-danger">{{addLoanErrors.customer_name[0]}}</p>
                    </div>
                    <div class="form-group">
                        <label>Loan Amount (LKR)</label>
                        <input type="text" placeholder="Loan Amount" class="form-control" v-model="addLoan.amount"/>
                        <p v-if="addLoanErrors.amount != null" class="text-danger">{{addLoanErrors.amount[0]}}</p>
                    </div>
                    <div class="form-group">
                        <label>Loan Duration (Months)</label>
                        <input type="number" placeholder="Duration" class="form-control" v-model="addLoan.duration"/>
                        <p v-if="addLoanErrors.duration != null" class="text-danger">{{addLoanErrors.duration[0]}}</p>
                    </div>
                    <div class="form-group">
                        <label>Bank File</label>
                        <input type="file" id="files" ref="bankFile" accept=".txt,.pdf,.csv" v-on:change="selectUploadedFile()" />
                        <p v-if="addLoanErrors.bankFile != null" class="text-danger">{{addLoanErrors.bankFile[0]}}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="createLoan()">Add Loan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'addLoan',
    data() {
        return {
            addLoan: {
                customer_name: '',
                amount: null,
                duration: null,
                bankFile: null
            },
            addLoanErrors:{
                customer_name: '',
                amount: null,
                duration: null,
                bankFile: null
            }
        }
    },
    methods : {
        createLoan : function (){

            let formData = new FormData();
            formData.append('customer_name',this.addLoan.customer_name);
            formData.append('amount',this.addLoan.amount);
            formData.append('duration',this.addLoan.duration);
            formData.append('bankFile',this.addLoan.bankFile);

            axios.post('/loans/add',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((response) => {
                //this.showAlert(response.data.message);
                $('#addLoan').modal('hide');
                this.$emit('loanAdded',response.data.data.theLoan);
            }).catch((error) => {
                this.addLoanErrors = {
                    customer_name: null,
                    amount: null,
                    duration: null,
                    bankFile: null
                }
                this.addLoanErrors = error.response.data.errors;

                console.log(this.addLoanErrors);
            });
        },
        hideModal : function (){
            this.addLoan = {
                customer_name: '',
                amount: null,
                duration: null,
                bankFile: null
            }
            this.addLoanErrors = {
                customer_name: '',
                amount: null,
                duration: null,
                bankFile: null
            }
        },
        selectUploadedFile : function (){
            this.addLoan.bankFile = this.$refs.bankFile.files[0];
        }
    },
    mounted (){
        $("#addLoan").on("hidden.bs.modal", this.hideModal);
    }
};
</script>
