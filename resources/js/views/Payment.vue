<template>
    <div class="" style="margin:5%">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <h4>Payment Form</h4>
            </div>
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="120px" label-position="top" class="demo-ruleForm">
                <h4>Personal Information</h4>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <el-form-item label="First name" prop="first_name">
                        <el-input v-model="ruleForm.first_name"></el-input>
                    </el-form-item>
                </div>
                <div>
                    <el-form-item label="Middle name" prop="middle_name">
                        <el-input v-model="ruleForm.middle_name"></el-input>
                    </el-form-item>
                </div>
                <div>
                    <el-form-item label="Last name" prop="last_name">
                        <el-input v-model="ruleForm.last_name"></el-input>
                    </el-form-item>
                </div>
            </div>
                <h4>Address Information</h4>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <el-form-item label="Phone Number" prop="phone_number">
                        <el-input v-model="ruleForm.phone_number"></el-input>
                    </el-form-item>
                </div>
                <div>
                    <el-form-item label="Email" prop="email">
                        <el-input v-model="ruleForm.email"></el-input>
                    </el-form-item>
                </div>
                <div>
                    <el-form-item label="Telephone" prop="telephone">
                        <el-input v-model="ruleForm.telephone"></el-input>
                    </el-form-item>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <el-form-item label="Country" prop="country">
                        <el-select v-model="ruleForm.country" style="width: 100%">
                            <el-option v-for="(country, index) in countries" :key="index" :label="country.label" :value="country.code"/>
                        </el-select>
                    </el-form-item>
                </div>
                <div>
                    <el-form-item label="City" prop="city">
                        <el-input v-model="ruleForm.city"></el-input>
                    </el-form-item>
                </div>
                <div>
                    <el-form-item label="State" prop="state">
                        <el-input v-model="ruleForm.state"></el-input>
                    </el-form-item>
                </div>
            </div>
                <h4>Payment Information</h4>
                <div class="grid grid-cols-3 gap-5">
                    <div>
                        <el-form-item label="Amount" prop="amount">
                            <el-input v-model="ruleForm.amount" type="number" style="width: 100%"/>
                        </el-form-item>
                    </div>
                    <div>
                        <el-form-item label="Currency" prop="currency" >
                        <el-select v-model="ruleForm.currency" style="width: 100%">
                            <el-option label="Nicaragua" value="558"/>
                        </el-select>
                        </el-form-item>
                    </div>
                </div>
            <div class="grid grid-cols-4 gap-4">
                <div>
                    <el-form-item label="Card Type" prop="card_type" >
                        <el-select v-model="ruleForm.card_type" style="width: 100%">
                            <el-option label="Visa" value="visa"/>
                            <el-option label="Master Card" value="master-card"/>
                            <el-option label="Amex" value="amex"/>
                        </el-select>
                    </el-form-item>
                </div>
                <div>
                    <el-form-item label="Card Number" prop="card_number">
                        <el-input v-model="ruleForm.card_number"></el-input>
                    </el-form-item>
                </div>
                <div>
                    <el-form-item label="Cvv2" prop="cvv">
                        <el-input v-model="ruleForm.cvv"></el-input>
                    </el-form-item>
                </div>
                <div>
                    <el-form-item label="Expire Date" prop="expire_dates">
                        <el-date-picker
                            v-model="ruleForm.expire_dates"
                            type="week"
                            format="yyyy/MM"
                            placeholder="Pick a expire date"
                            style="width: 100%"
                        >
                        </el-date-picker>
                    </el-form-item>
                </div>
            </div>
                <div class="float-right">
                    <el-form-item>
                        <el-button type="primary" @click="submitForm('ruleForm')" :loading="checkoutLoading">Pay</el-button>
                        <el-button @click="resetForm('ruleForm')">Reset</el-button>
                    </el-form-item>
                </div>
            </el-form>
        </el-card>
        <div v-if="HtmlBody.transaction3Ds">
            <div v-html="HtmlBody.htmlForm"/>
            <div>
                <el-button type="primary" @click="submitPaymentForm">
                    Continue
                </el-button>
            </div>
        </div>
        <el-dialog
            title="Payment Status"
            :visible.sync="successPaymentDialogVisible"
            width="30%">
            <div v-if="HtmlBody.transaction">
                <label>
                    {{HtmlBody.reasonCodeDescription}}
                </label> <br>
                <label>
                    {{HtmlBody.paddedCardNumber}}
                </label>
            </div>
            <div v-else>
                <label>
                    Somthing went wrong please try again!
                </label><br>
                <p v-if="HtmlBody.exception">
                    {{HtmlBody.exception}}
                </p>
            </div>
            <span slot="footer" class="dialog-footer">
                <el-button @click="successPaymentDialogVisible = false">Close</el-button>
              </span>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: "Payment",
        data() {
            return {
                value: '',
                HtmlBody: {},
                successPaymentDialogVisible: false,
                checkoutLoading: false,
                countries: [
                    {label:'Nicaragua', code: '558'},
                    {label:'U.S.A', code: '840'}
                ],
                ruleForm: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    phone_number: '',
                    email: '',
                    telephone: '',
                    country: '',
                    city: '',
                    state: '',
                    card_type: '',
                    card_number: '',
                    cvv: '',
                    expire_dates: '',
                    amount:'',
                    currency: '558'
                },
                rules: {
                    first_name: [
                        { required: true, message: 'First name is required', trigger: 'blur' },
                    ],
                    last_name: [
                        { required: true, message: 'Last name is required', trigger: 'blur' }
                    ],
                    phone_number: [
                        { required: true, message: 'Phone number is required', trigger: 'blur' }
                    ],
                    email: [
                        { required: true, message: 'Email is required', trigger: 'blur' }
                    ],
                    country: [
                        { required: true, message: 'Country is required', trigger: 'blur' }
                    ],
                    city: [
                        { required: true, message: 'City is required', trigger: 'blur' }
                    ],
                    card_type: [
                        { required: true, message: 'Card Type is required', trigger: 'blur' },
                    ],
                    card_number: [
                        { required: true, message: 'Card Number is required', trigger: 'blur' },
                        { min: 14, max: 16, message: 'Length should be 14 to 16', trigger: 'blur' }
                    ],
                    cvv: [
                        { required: true, message: 'Card CVV2 is required', trigger: 'blur' },
                        { min: 3, max: 4, message: 'Length should be 3 to 5', trigger: 'blur' }
                    ],
                    expire_dates: [
                        { required: true, message: 'Card Expire date is required', trigger: 'blur' }
                    ]
                }
            }
        },
        mounted() {

        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.checkoutPayment()
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            submitPaymentForm() {
                document.getElementById('frmHtmlCheckout').submit()
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            async checkoutPayment() {
                const loading = this.$loading({
                    lock: true,
                    text: 'Loading',
                    spinner: 'el-icon-loading',
                    background: 'rgba(0, 0, 0, 0.7)'
                });
                this.checkoutLoading = true
                this.ruleForm.expire_date = new Date(this.ruleForm.expire_date)
                var self=this;
                await axios.post('/checkout',this.ruleForm).then(async function (response) {
                    self.HtmlBody = response.data;
                    console.log(self.HtmlBody)
                    if(response.data.transaction) {
                        self.successPaymentDialogVisible = true
                        loading.close()
                    }
                    await setTimeout(
                        function() {
                            document.getElementById('frmHtmlCheckout').submit()
                        }, 1000);

                }) .catch(function (error) {
                    // handle error
                    console.log(error);
                    loading.close()
                })
                await this.resetForm('ruleForm')
                this.checkoutLoading = false
            }
        }
    }
</script>

<style scoped>
    .pt-header {
        /*height: 90vh;*/
    }
    .loader {
        border-top-color: #3498db;
        -webkit-animation: spinner 1.5s linear infinite;
        animation: spinner 1.5s linear infinite;

    }

    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spinner {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
