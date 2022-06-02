<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailSMSTemplateSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('email_sms_templates')->insert([
            [
                "name"         => "Deposit Money",
                "slug"         => "DEPOSIT_MONEY",
                "subject"      => "Deposit Money",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your account has been credited by {{amount}} on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your account has been credited by {{amount}} on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Deposit Request Approved",
                "slug"         => "DEPOSIT_REQUEST_APPROVED",
                "subject"      => "Deposit Request Approved",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your deposit request has been approved. Your account has been credited by {{amount}} on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your deposit request has been approved. Your account has been credited by {{amount}} on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}} {{depositMethod}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "FDR Request Approved",
                "slug"         => "FDR_REQUEST_APPROVED",
                "subject"      => "FDR Request Approved",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your FDR request of {{amount}} has been approved on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your FDR request of {{amount}} has been approved on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Loan Request Approved",
                "slug"         => "LOAN_REQUEST_APPROVED",
                "subject"      => "Loan Request Approved",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your loan request has been approved. Your account has been credited by {{amount}} on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your loan request has been approved. Your account has been credited by {{amount}} on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Transfer Request Approved",
                "slug"         => "TRANSFER_REQUEST_APPROVED",
                "subject"      => "Transfer Request Approved",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your transfer request has been approved. Your account has been debited by {{amount}} on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your transfer request has been approved. Your account has been debited by {{amount}} on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Wire Transfer Request Approved",
                "slug"         => "WIRE_TRANSFER_REQUEST_APPROVED",
                "subject"      => "Wire Transfer Request Approved",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your wire transfer request has been approved. Your account has been debited by {{amount}} on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your wire transfer request has been approved. Your account has been debited by {{amount}} on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Withdraw Request Approved",
                "slug"         => "WITHDRAW_REQUEST_APPROVED",
                "subject"      => "Withdraw Request Approved",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your withdraw request has been approved. Your account has been debited by {{amount}} on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your withdraw request has been approved. Your account has been debited by {{amount}} on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "FDR Matured",
                "slug"         => "FDR_MATURED",
                "subject"      => "FDR Matured",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your FDR is already matured. Your account has been credited by {{amount}} on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your FDR is already matured. Your account has been credited by {{amount}} on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Payment Request",
                "slug"         => "PAYMENT_REQUEST",
                "subject"      => "You have Received New Payment Request",
                "email_body"   => "<div>Dear Sir,</div>\r\n<div>Your have received new payment request of {{amount}} on {{dateTime}}.</div>\r\n<div>&nbsp;</div>\r\n<div>{{payNow}}</div>",
                "sms_body"     => "Dear Sir, Your have received new payment request of {{amount}} on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}} {{payNow}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Payment Completed",
                "slug"         => "PAYMENT_COMPLETED",
                "subject"      => "Payment Completed",
                "email_body"   => "<div>Dear Sir,</div>\r\n<div>Good news, You have received a payment of {{amount}} on {{dateTime}} from {{paidBy}}</div>",
                "sms_body"     => "Dear Sir, Good news, You have received a payment of {{amount}} on {{dateTime}} from {{paidBy}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}} {{paidBy}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Deposit Request Rejected",
                "slug"         => "DEPOSIT_REQUEST_REJECTED",
                "subject"      => "Deposit Request Rejected",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your deposit request of {{amount}} has been rejected.</div>\r\n<div>&nbsp;</div>\r\n<div>Amount:&nbsp;{{amount}}</div>\r\n<div>Deposit Method: {{depositMethod}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your deposit request of {{amount}} has been rejected.",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{depositMethod}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "FDR Request Rejected",
                "slug"         => "FDR_REQUEST_REJECTED",
                "subject"      => "FDR Request Rejected",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your FDR request has been rejected. Your FDR amount {{amount}} has returned back to your account.</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your FDR request has been rejected. Your FDR amount {{amount}} has returned back to your account.",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Loan Request Rejected",
                "slug"         => "LOAN_REQUEST_REJECTED",
                "subject"      => "Loan Request Rejected",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your loan request of {{amount}} has been rejected on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your loan request of {{amount}} has been rejected on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Transfer Request Rejected",
                "slug"         => "TRANSFER_REQUEST_REJECTED",
                "subject"      => "Transfer Request Rejected",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your transfer request has been rejected. Your transferred amount {{amount}} has returned back to your account.</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your transfer request has been rejected. Your transferred amount {{amount}} has returned back to your account.",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Wire Transfer Rejected",
                "slug"         => "WIRE_TRANSFER_REJECTED",
                "subject"      => "Wire Transfer Rejected",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your wire transfer request has been rejected. Your transferred amount {{amount}} has returned back to your account.</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your wire transfer request has been rejected. Your transferred amount {{amount}} has returned back to your account.",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Withdraw Request Rejected",
                "slug"         => "WITHDRAW_REQUEST_REJECTED",
                "subject"      => "Withdraw Request Rejected",
                "email_body"   => "<div>\r\n<div>Dear Sir, Your withdraw request has been rejected. Your transferred amount {{amount}} has returned back to your account.</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your withdraw request has been rejected. Your transferred amount {{amount}} has returned back to your account.",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
            [
                "name"         => "Withdraw Money",
                "slug"         => "WITHDRAW_MONEY",
                "subject"      => "Withdraw Money",
                "email_body"   => "<div>\r\n<div>Dear Sir,</div>\r\n<div>Your account has been debited by {{amount}} on {{dateTime}}</div>\r\n</div>",
                "sms_body"     => "Dear Sir, Your account has been debited by {{amount}} on {{dateTime}}",
                "shortcode"    => "{{name}} {{email}} {{phone}} {{amount}} {{dateTime}} {{withdrawMethod}}",
                "email_status" => 0,
                "sms_status"   => 0,
            ],
        ]);
    }
}
