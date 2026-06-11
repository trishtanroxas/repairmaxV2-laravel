<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $type == 'invoice' ? 'Invoice' : 'Receipt' }} - {{ $appointment->booking_number ?: $appointment->tracking_code }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            /* Using DejaVu Sans to support Unicode characters like the Peso symbol ₱ correctly */
            font-family: 'DejaVu Sans', 'Helvetica Neue', Arial, sans-serif;
            color: #334155;
            line-height: 1.4;
            background: #fff;
            padding: 15px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        /* Accent Top Border */
        .top-stripe {
            height: 6px;
            width: 100%;
            background-color: {{ $type == 'invoice' ? '#1e3a8a' : '#10b981' }};
            margin-bottom: 12px;
            border-radius: 3px;
        }

        /* Header Layouts */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .header-logo {
            width: 55%;
            vertical-align: middle;
        }

        .header-meta {
            width: 45%;
            text-align: right;
            vertical-align: middle;
        }

        .logo-image {
            height: 32px;
            width: auto;
            display: inline-block;
        }

        .tagline {
            font-size: 9px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 4px;
            font-weight: bold;
        }

        .doc-title {
            font-size: 20px;
            font-weight: 850;
            color: {{ $type == 'invoice' ? '#1e3a8a' : '#047857' }};
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .doc-ref {
            font-size: 11px;
            color: #475569;
            font-weight: bold;
        }

        /* Invoice Custom Top Banner */
        .invoice-banner {
            background: #0f172a;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            margin-bottom: 15px;
        }

        .invoice-banner-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-banner-logo {
            width: 55%;
            vertical-align: middle;
            color: white;
        }

        .invoice-banner-meta {
            width: 45%;
            text-align: right;
            vertical-align: middle;
            color: white;
        }

        /* Info Card Panels (Receipt) */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .info-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px;
            vertical-align: top;
        }

        .card-title {
            font-size: 10px;
            font-weight: bold;
            color: {{ $type == 'invoice' ? '#1e3a8a' : '#047857' }};
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }

        .detail-row {
            margin-bottom: 4px;
            font-size: 11px;
        }

        .detail-label {
            color: #64748b;
            display: inline-block;
            width: 35%;
        }

        .detail-val {
            font-weight: bold;
            color: #1e293b;
        }

        /* Status Banner */
        .status-banner {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .status-cell {
            background-color: {{ $type == 'invoice' ? '#f8fafc' : '#ecfdf5' }};
            border: 1px solid {{ $type == 'invoice' ? '#e2e8f0' : '#a7f3d0' }};
            border-left: 4px solid {{ $type == 'invoice' ? '#2563eb' : '#10b981' }};
            padding: 8px 12px;
            border-radius: 6px;
        }

        .status-label {
            font-size: 9px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .status-value {
            font-size: 12px;
            font-weight: bold;
            color: {{ $type == 'invoice' ? '#1e3a8a' : '#065f46' }};
            margin-top: 2px;
        }

        /* Device Section (Receipt) */
        .section-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 12px;
        }

        .section-header {
            font-size: 10px;
            font-weight: bold;
            color: {{ $type == 'invoice' ? '#1e3a8a' : '#047857' }};
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }

        .device-table {
            width: 100%;
            border-collapse: collapse;
        }

        .device-cell {
            width: 50%;
            vertical-align: top;
        }

        .device-label {
            font-size: 9px;
            color: #64748b;
            margin-bottom: 2px;
        }

        .device-val {
            font-size: 12px;
            font-weight: bold;
            color: #1e293b;
        }

        /* Description Box */
        .description-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 12px;
            font-size: 11px;
        }

        .description-text {
            color: #475569;
            line-height: 1.4;
            white-space: pre-wrap;
            max-height: 80px;
            overflow: hidden;
        }

        /* Tech Notes Box */
        .notes-box {
            background: #fffbeb;
            border: 1px solid #fef3c7;
            border-left: 4px solid #d97706;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 12px;
            font-size: 11px;
        }

        .notes-title {
            font-size: 10px;
            font-weight: bold;
            color: #b45309;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .notes-text {
            color: #78350f;
            line-height: 1.4;
            white-space: pre-wrap;
        }

        /* Invoice Table (Line-Items) */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            font-size: 11px;
        }

        .invoice-table th {
            background: #f1f5f9;
            border-bottom: 2px solid #cbd5e1;
            padding: 8px 10px;
            text-align: left;
            font-weight: bold;
            color: #475569;
            text-transform: uppercase;
        }

        .invoice-table td {
            border-bottom: 1px solid #e2e8f0;
            padding: 8px 10px;
            vertical-align: middle;
        }

        /* Financial Summary Table */
        .pricing-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            margin-top: 10px;
            margin-bottom: 12px;
        }

        .pricing-table tr {
            border-bottom: 1px solid #f1f5f9;
        }

        .pricing-table td {
            padding: 6px 0;
        }

        .pricing-table .label {
            text-align: right;
            padding-right: 20px;
            color: #64748b;
            width: 75%;
        }

        .pricing-table .val {
            text-align: right;
            font-weight: bold;
            color: #1e293b;
            width: 25%;
        }

        .pricing-table .total-row {
            background-color: {{ $type == 'invoice' ? '#1e3a8a' : '#10b981' }};
            color: white;
            font-weight: bold;
            font-size: 13px;
        }

        .pricing-table .total-row td {
            padding: 8px 12px;
            color: white !important;
        }

        /* Stamp watermark */
        .stamp {
            position: absolute;
            right: 20px;
            top: 65px;
            border: 3px double {{ $type == 'invoice' ? '#60a5fa' : '#10b981' }};
            color: {{ $type == 'invoice' ? '#60a5fa' : '#10b981' }};
            font-size: 13px;
            font-weight: bold;
            padding: 4px 8px;
            transform: rotate(-6deg);
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: transparent;
            opacity: 0.5;
            z-index: 10;
        }

        .footer {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Top Stripe Theme Indicator -->
        <div class="top-stripe"></div>

        <!-- Watermark Stamp -->
        @if($appointment->status == 'Completed')
            <div class="stamp">{{ $type == 'invoice' ? 'INVOICED' : 'PAID' }}</div>
        @else
            <div class="stamp">{{ $appointment->status }}</div>
        @endif

        @if($type == 'invoice')
            <!-- ================= INVOICE HEADER (DARK THEME) ================= -->
            <div class="invoice-banner">
                <table class="invoice-banner-table">
                    <tr>
                        <td class="invoice-banner-logo">
                            <img src="{{ public_path('img/logo-r-white.png') }}" class="logo-image" alt="RepairMax Logo">
                            <div style="font-size: 9px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; font-weight: bold; margin-top: 4px;">Premium Repair Specialists</div>
                        </td>
                        <td class="invoice-banner-meta">
                            <div style="font-size: 20px; font-weight: 850; letter-spacing: 0.5px; margin-bottom: 4px; color: white;">INVOICE</div>
                            <div style="font-size: 11px; color: #cbd5e1; font-family: monospace;">Invoice #: {{ $appointment->invoice_number ?? 'Pending' }}</div>
                            <div style="font-size: 11px; color: #94a3b8; font-family: monospace; margin-top: 2px;">Booking Ref: {{ $appointment->booking_number ?: $appointment->tracking_code }}</div>
                        </td>
                    </tr>
                </table>
            </div>
        @else
            <!-- ================= RECEIPT HEADER (LIGHT THEME) ================= -->
            <table class="header-table">
                <tr>
                    <td class="header-logo">
                        <img src="{{ public_path('img/logo-r-blue.png') }}" class="logo-image" alt="RepairMax Logo">
                        <div class="tagline">Premium Repair Specialists</div>
                    </td>
                    <td class="header-meta">
                        <div class="doc-title">SERVICE RECEIPT</div>
                        <div class="doc-ref">
                            Ref #: {{ $appointment->booking_number ?: $appointment->tracking_code }}
                        </div>
                        @if($appointment->invoice_number)
                        <div class="doc-ref" style="margin-top: 2px;">
                            Invoice #: {{ $appointment->invoice_number }}
                        </div>
                        @endif
                    </td>
                </tr>
            </table>
        @endif

        <!-- Status Banner -->
        <table class="status-banner">
            <tr>
                <td class="status-cell">
                    <div class="status-label">Current Appointment Status</div>
                    <div class="status-value">{{ $appointment->status }}</div>
                </td>
            </tr>
        </table>

        <!-- Customer & Service Info -->
        <table class="info-table">
            <tr>
                <!-- Left: Customer Card -->
                <td class="info-card" style="width: 48%;">
                    <div class="card-title">Customer Information</div>
                    <div class="detail-row">
                        <span class="detail-label">Name:</span>
                        <span class="detail-val">{{ $user->first_name }} {{ $user->last_name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email:</span>
                        <span class="detail-val" style="font-size: 10px;">{{ $user->email }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Phone:</span>
                        <span class="detail-val">{{ $user->phone }}</span>
                    </div>
                </td>
                <!-- Middle Spacer -->
                <td style="width: 4%;"></td>
                <!-- Right: Service Card -->
                <td class="info-card" style="width: 48%;">
                    <div class="card-title">{{ $type == 'invoice' ? 'Invoice Details' : 'Service Details' }}</div>
                    @if($type == 'invoice' || $appointment->invoice_number)
                    <div class="detail-row">
                        <span class="detail-label">Invoice #:</span>
                        <span class="detail-val" style="font-family: monospace;">{{ $appointment->invoice_number ?? 'Pending' }}</span>
                    </div>
                    @endif
                    <div class="detail-row">
                        <span class="detail-label">Booking Ref:</span>
                        <span class="detail-val" style="font-family: monospace;">{{ $appointment->booking_number ?: $appointment->tracking_code }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Service Date:</span>
                        <span class="detail-val">{{ $appointment->pref_date->format('M d, Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Schedule Time:</span>
                        <span class="detail-val">{{ \Carbon\Carbon::parse($appointment->pref_time)->format('h:i A') }}</span>
                    </div>
                </td>
            </tr>
        </table>

        @if($type == 'invoice')
            <!-- ================= INVOICE LINE-ITEM TABLE LAYOUT ================= -->
            <div style="border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; margin-bottom: 20px;">
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th style="width: 55%;">Service / Item Description</th>
                            <th style="width: 20%; text-align: center;">Device</th>
                            <th style="width: 25%; text-align: right;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong style="color: #1e293b; font-size: 12px;">{{ $appointment->fault_category }}</strong>
                                <div style="color: #64748b; font-size: 10px; margin-top: 3px;">Initial quote estimate & diagnostics assessment fee</div>
                            </td>
                            <td style="text-align: center; color: #475569;">
                                {{ $appointment->device_brand }}<br><span style="font-size: 10px; color: #64748b;">{{ $appointment->device_model }}</span>
                            </td>
                            <td style="text-align: right; font-weight: bold; color: #1e293b;">
                                ₱{{ number_format($appointment->quote ?? 0, 2) }}
                            </td>
                        </tr>
                        @if(is_numeric($appointment->final_cost) && ($appointment->final_cost != $appointment->quote))
                        <tr>
                            <td>
                                <strong style="color: #1e293b; font-size: 12px;">Labor & Additional Repair Fees</strong>
                                <div style="color: #64748b; font-size: 10px; margin-top: 3px;">Cost adjustments applied during technical repair work</div>
                            </td>
                            <td style="text-align: center; color: #475569;">—</td>
                            <td style="text-align: right; font-weight: bold; color: #1e293b;">
                                ₱{{ number_format($appointment->final_cost - ($appointment->quote ?? 0), 2) }}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @else
            <!-- ================= RECEIPT SIMPLE DIAGNOSTICS BOX ================= -->
            <div class="section-box">
                <div class="section-header">Device & Issue Diagnostics</div>
                <table class="device-table">
                    <tr>
                        <td class="device-cell">
                            <div class="device-label">Device Brand & Model</div>
                            <div class="device-val">{{ $appointment->device_brand }} {{ $appointment->device_model }}</div>
                        </td>
                        <td class="device-cell">
                            <div class="device-label">Fault/Issue Category</div>
                            <div class="device-val">{{ $appointment->fault_category }}</div>
                        </td>
                    </tr>
                </table>
            </div>
        @endif

        <!-- Issue Description -->
        @if($appointment->description)
        <div class="description-box">
            <div class="section-header" style="margin-bottom: 8px;">Description of Issue</div>
            <div class="description-text">{{ $appointment->description }}</div>
        </div>
        @endif

        <!-- Completion Notes (Technician) -->
        @if($type == 'invoice' && $appointment->completion_notes)
        <div class="notes-box">
            <div class="notes-title">Technician Completion Notes</div>
            <div class="notes-text">{{ $appointment->completion_notes }}</div>
        </div>
        @endif

        <!-- Financial Summaries (Align Totals depending on invoice layout) -->
        @if($type == 'invoice')
            <!-- Right-aligned invoice totals summary table -->
            <table style="width: 40%; margin-left: 60%; border-collapse: collapse; font-size: 11px; margin-bottom: 12px; margin-top: 8px;">
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 4px 0; color: #64748b; text-align: right;">Subtotal:</td>
                    <td style="padding: 4px 0; font-weight: bold; color: #1e293b; text-align: right;">₱{{ number_format($appointment->quote ?? 0, 2) }}</td>
                </tr>
                @if(is_numeric($appointment->final_cost) && ($appointment->final_cost != $appointment->quote))
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 4px 0; color: #64748b; text-align: right;">Adjustments:</td>
                    <td style="padding: 4px 0; font-weight: bold; color: #1e293b; text-align: right;">₱{{ number_format($appointment->final_cost - $appointment->quote, 2) }}</td>
                </tr>
                @endif
                <tr style="background: #1e3a8a; color: white; font-weight: bold; font-size: 12px;">
                    <td style="padding: 6px 10px; text-align: right; border-radius: 4px 0 0 4px;">Total Due:</td>
                    <td style="padding: 6px 10px; text-align: right; border-radius: 0 4px 4px 0; color: white !important;">₱{{ number_format($appointment->final_cost ?? $appointment->quote ?? 0, 2) }}</td>
                </tr>
            </table>
        @else
            <!-- Standard receipt full width table -->
            <table class="pricing-table">
                <tr>
                    <td class="label">Estimated Diagnostics Quote:</td>
                    <td class="val">₱{{ number_format($appointment->quote ?? 0, 2) }}</td>
                </tr>
                @if(is_numeric($appointment->final_cost))
                    <tr>
                        <td class="label">Final Service Cost:</td>
                        <td class="val">₱{{ number_format($appointment->final_cost, 2) }}</td>
                    </tr>
                    @if($appointment->final_cost != $appointment->quote && $appointment->quote)
                        <tr>
                            <td class="label">Price Adjustment:</td>
                            <td class="val">₱{{ number_format($appointment->final_cost - $appointment->quote, 2) }}</td>
                        </tr>
                    @endif
                    <tr class="total-row">
                        <td class="label" style="border-radius: 6px 0 0 6px;">TOTAL AMOUNT PAID:</td>
                        <td class="val" style="border-radius: 0 6px 6px 0; text-align: right;">₱{{ number_format($appointment->final_cost, 2) }}</td>
                    </tr>
                @else
                    <tr class="total-row">
                        <td class="label" style="border-radius: 6px 0 0 6px;">ESTIMATED TOTAL DUE:</td>
                        <td class="val" style="border-radius: 0 6px 6px 0; text-align: right;">₱{{ number_format($appointment->quote ?? 0, 2) }}</td>
                    </tr>
                @endif
            </table>
        @endif

        <!-- Footer -->
        <div class="footer">
            <div class="footer-text">Thank you for choosing RepairMax for your device repair needs!</div>
            <div class="footer-text">Document generated on {{ now()->format('M d, Y \a\t h:i A') }}</div>
            <div class="footer-text" style="color: #cbd5e1; margin-top: 8px;">
                This {{ $type }} is electronically generated and valid without signature.
            </div>
        </div>
    </div>
</body>
</html>
