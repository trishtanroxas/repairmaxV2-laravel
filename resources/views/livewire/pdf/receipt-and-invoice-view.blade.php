<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt & Invoice - {{ $appointment->booking_number ?: $appointment->tracking_code }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #334155;
            background: #f1f5f9;
            padding: 30px 20px;
            font-size: 12px;
            line-height: 1.4;
        }

        /* ── Controls ── */
        .controls {
            display: flex; gap: 10px; margin-bottom: 24px;
            justify-content: center; flex-wrap: wrap;
        }
        .btn {
            padding: 9px 22px; border: none; border-radius: 9999px;
            cursor: pointer; font-size: 13px; font-weight: 700;
            display: inline-flex; align-items: center; gap: 6px;
            transition: all 0.2s;
        }
        .btn-primary { background: #1e3a8a; color: white; }
        .btn-primary:hover { background: #1e40af; }
        .btn-secondary { background: white; color: #4b5563; border: 1px solid #e2e8f0; }
        .btn-success { background: #10b981; color: white; }

        /* ── Document Card ── */
        .doc-card {
            max-width: 780px; margin: 0 auto 30px;
            background: white; border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            overflow: hidden; border: 1px solid #e2e8f0;
        }

        /* ── Dark Header ── */
        .doc-header {
            padding: 20px 28px 18px;
            display: flex; justify-content: space-between; align-items: center;
            position: relative;
        }
        .doc-header-receipt { background: #064e3b; }
        .doc-header-invoice { background: #1e3a8a; }

        .logo-area { display: flex; flex-direction: column; gap: 3px; }
        .logo-img { height: 32px; width: auto; }
        .company-tagline {
            font-size: 9px; color: rgba(255,255,255,0.6);
            text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700;
        }

        .doc-title-area { text-align: right; }
        .doc-title {
            font-size: 22px; font-weight: 900; color: white;
            letter-spacing: -0.5px; line-height: 1;
        }
        .doc-ref { font-size: 11px; color: rgba(255,255,255,0.7); font-family: monospace; margin-top: 3px; }

        /* ── Stamp (in header, not over content) ── */
        .stamp {
            position: absolute; right: 28px; top: 50%;
            transform: translateY(-50%) rotate(-6deg);
            border: 2px solid rgba(255,255,255,0.5);
            color: white; font-size: 11px; font-weight: 900;
            padding: 4px 10px; border-radius: 5px;
            text-transform: uppercase; letter-spacing: 2px;
            white-space: nowrap;
        }

        /* ── Body Content ── */
        .doc-body { padding: 20px 28px; }

        /* Status strip */
        .status-strip {
            display: flex; align-items: center; gap: 10px;
            padding: 8px 14px; border-radius: 8px; margin-bottom: 16px;
        }
        .status-strip-receipt { background: #ecfdf5; border-left: 3px solid #10b981; }
        .status-strip-invoice { background: #eff6ff; border-left: 3px solid #2563eb; }
        .status-label { font-size: 9px; color: #64748b; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }
        .status-val-receipt { font-size: 13px; font-weight: 800; color: #065f46; }
        .status-val-invoice { font-size: 13px; font-weight: 800; color: #1e3a8a; }

        /* Two-col info grid */
        .info-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 14px; margin-bottom: 14px;
        }
        .info-card {
            background: #f8fafc; border: 1px solid #e2e8f0;
            border-radius: 12px; padding: 14px;
        }
        .card-header-receipt {
            font-size: 9px; font-weight: 800; color: #047857;
            text-transform: uppercase; letter-spacing: 0.5px;
            margin-bottom: 8px; border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }
        .card-header-invoice {
            font-size: 9px; font-weight: 800; color: #1e3a8a;
            text-transform: uppercase; letter-spacing: 0.5px;
            margin-bottom: 8px; border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }
        .info-row { margin-bottom: 5px; display: flex; gap: 6px; }
        .info-row-label { color: #64748b; min-width: 90px; }
        .info-row-value { font-weight: 700; color: #1e293b; }

        /* Invoice table */
        .invoice-table {
            width: 100%; border-collapse: collapse;
            font-size: 12px; margin-bottom: 14px;
            border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;
        }
        .invoice-table th {
            background: #f1f5f9; border-bottom: 1px solid #e2e8f0;
            padding: 9px 12px; text-align: left; font-weight: 800;
            color: #475569; text-transform: uppercase; font-size: 9px; letter-spacing: 0.5px;
        }
        .invoice-table td {
            border-bottom: 1px solid #f1f5f9;
            padding: 10px 12px; vertical-align: middle;
        }
        .invoice-table tr:last-child td { border-bottom: none; }

        /* Description — compact, truncated for single-page fit */
        .desc-box {
            background: #f8fafc; border: 1px solid #e2e8f0;
            border-radius: 10px; padding: 12px 14px; margin-bottom: 14px;
        }
        .desc-header-receipt { font-size: 9px; font-weight: 800; color: #047857; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .desc-header-invoice { font-size: 9px; font-weight: 800; color: #1e3a8a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .desc-content {
            color: #475569; font-size: 11px; line-height: 1.5;
            white-space: pre-wrap; max-height: 80px; overflow: hidden;
        }

        /* Pricing / Total */
        .pricing-area { margin-top: 10px; }
        .pricing-row {
            display: flex; justify-content: flex-end;
            padding: 5px 0; border-bottom: 1px solid #f1f5f9;
        }
        .pricing-label { color: #64748b; margin-right: 40px; }
        .pricing-val { font-weight: 700; color: #1e293b; min-width: 90px; text-align: right; }
        .total-bar-receipt {
            display: flex; justify-content: flex-end; align-items: center;
            background: #064e3b; color: white; padding: 10px 16px;
            border-radius: 10px; margin-top: 6px;
        }
        .total-bar-invoice {
            display: flex; justify-content: flex-end; align-items: center;
            background: #1e3a8a; color: white; padding: 10px 16px;
            border-radius: 10px; margin-top: 6px;
        }
        .total-label { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; margin-right: 40px; }
        .total-val { font-size: 16px; font-weight: 900; min-width: 90px; text-align: right; }

        /* Footer */
        .doc-footer {
            border-top: 1px solid #e2e8f0; margin-top: 14px;
            padding-top: 10px; text-align: center;
            font-size: 10px; color: #94a3b8; line-height: 1.6;
        }

        @media print {
            body { background: white; padding: 0; }
            .controls { display: none; }
            .doc-card {
                box-shadow: none; border-radius: 0; border: none;
                margin: 0; max-width: 100%;
                page-break-after: always;
            }
            .doc-card:last-child { page-break-after: auto; }
        }
    </style>
</head>
<body>

    <!-- Controls -->
    <div class="controls">
        <button class="btn btn-primary" onclick="window.print()">🖨️ Print</button>
        <button class="btn btn-secondary" onclick="downloadAsHTML()">📥 Download HTML</button>
        <button class="btn btn-success" onclick="window.history.back()">← Back</button>
    </div>

    {{-- ══════════════════════════════════ --}}
    {{-- RECEIPT                           --}}
    {{-- ══════════════════════════════════ --}}
    <div class="doc-card">

        <div class="doc-header doc-header-receipt">
            <div class="logo-area">
                <img src="{{ asset('img/logo-r-white.png') }}" class="logo-img" alt="RepairMax">
                <div class="company-tagline">Premium Repair Specialists</div>
            </div>
            <div class="doc-title-area" style="margin-right: 80px;">
                <div class="doc-title">SERVICE RECEIPT</div>
                <div class="doc-ref">Ref #: {{ $appointment->booking_number ?: $appointment->tracking_code }}</div>
                @if($appointment->invoice_number)
                <div class="doc-ref">Invoice #: {{ $appointment->invoice_number }}</div>
                @endif
            </div>
            <div class="stamp">
                @if($appointment->status == 'Completed') PAID @else {{ $appointment->status }} @endif
            </div>
        </div>

        <div class="doc-body">

            <div class="status-strip status-strip-receipt">
                <div>
                    <div class="status-label">Current Appointment Status</div>
                    <div class="status-val-receipt">{{ $appointment->status }}</div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <div class="card-header-receipt">Customer Information</div>
                    <div class="info-row">
                        <span class="info-row-label">Name:</span>
                        <span class="info-row-value">{{ $user->first_name }} {{ $user->last_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label">Email:</span>
                        <span class="info-row-value" style="font-size:11px;">{{ $user->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label">Phone:</span>
                        <span class="info-row-value">{{ $user->phone }}</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="card-header-receipt">Service Details</div>
                    @if($appointment->invoice_number)
                    <div class="info-row">
                        <span class="info-row-label">Invoice #:</span>
                        <span class="info-row-value" style="font-family:monospace;">{{ $appointment->invoice_number }}</span>
                    </div>
                    @endif
                    <div class="info-row">
                        <span class="info-row-label">Booking Ref:</span>
                        <span class="info-row-value" style="font-family:monospace;">{{ $appointment->booking_number ?: $appointment->tracking_code }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label">Device:</span>
                        <span class="info-row-value">{{ $appointment->device_brand }} {{ $appointment->device_model }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label">Service Date:</span>
                        <span class="info-row-value">{{ $appointment->pref_date->format('M d, Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label">Schedule Time:</span>
                        <span class="info-row-value">{{ \Carbon\Carbon::parse($appointment->pref_time)->format('h:i A') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label">Issue:</span>
                        <span class="info-row-value">{{ $appointment->fault_category }}</span>
                    </div>
                </div>
            </div>

            @if($appointment->description)
            <div class="desc-box">
                <div class="desc-header-receipt">Description of Issue</div>
                <div class="desc-content">{{ $appointment->description }}</div>
            </div>
            @endif

            <div class="pricing-area">
                <div class="pricing-row">
                    <span class="pricing-label">Estimated Diagnostics Quote</span>
                    <span class="pricing-val">₱{{ number_format($appointment->quote ?? 0, 2) }}</span>
                </div>
                @if(is_numeric($appointment->final_cost))
                    @if($appointment->final_cost != $appointment->quote && $appointment->quote)
                    <div class="pricing-row">
                        <span class="pricing-label">Price Adjustment</span>
                        <span class="pricing-val">₱{{ number_format($appointment->final_cost - $appointment->quote, 2) }}</span>
                    </div>
                    @endif
                    <div class="total-bar-receipt">
                        <span class="total-label">Total Amount Paid</span>
                        <span class="total-val">₱{{ number_format($appointment->final_cost, 2) }}</span>
                    </div>
                @else
                    <div class="total-bar-receipt">
                        <span class="total-label">Estimated Total Due</span>
                        <span class="total-val">₱{{ number_format($appointment->quote ?? 0, 2) }}</span>
                    </div>
                @endif
            </div>

            <div class="doc-footer">
                <div>Thank you for choosing RepairMax for your device repair needs!</div>
                <div>Document generated on {{ now()->format('M d, Y \a\t h:i A') }}</div>
                <div style="font-style:italic; margin-top: 2px;">This receipt is electronically generated and valid without signature.</div>
            </div>

        </div>
    </div>

    {{-- ══════════════════════════════════ --}}
    {{-- INVOICE                           --}}
    {{-- ══════════════════════════════════ --}}
    <div class="doc-card">

        <div class="doc-header doc-header-invoice">
            <div class="logo-area">
                <img src="{{ asset('img/logo-r-white.png') }}" class="logo-img" alt="RepairMax">
                <div class="company-tagline">Premium Repair Specialists</div>
            </div>
            <div class="doc-title-area" style="margin-right: 80px;">
                <div class="doc-title">INVOICE</div>
                <div class="doc-ref">Invoice #: {{ $appointment->invoice_number ?? 'Pending' }}</div>
                <div class="doc-ref">Booking Ref: {{ $appointment->booking_number ?: $appointment->tracking_code }}</div>
            </div>
            <div class="stamp">
                @if($appointment->status == 'Completed') INVOICED @else {{ $appointment->status }} @endif
            </div>
        </div>

        <div class="doc-body">

            <div class="status-strip status-strip-invoice">
                <div>
                    <div class="status-label">Current Appointment Status</div>
                    <div class="status-val-invoice">{{ $appointment->status }}</div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <div class="card-header-invoice">Billing Information</div>
                    <div class="info-row">
                        <span class="info-row-label">Name:</span>
                        <span class="info-row-value">{{ $user->first_name }} {{ $user->last_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label">Email:</span>
                        <span class="info-row-value" style="font-size:11px;">{{ $user->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label">Phone:</span>
                        <span class="info-row-value">{{ $user->phone }}</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="card-header-invoice">Invoice Details</div>
                    <div class="info-row">
                        <span class="info-row-label">Invoice #:</span>
                        <span class="info-row-value" style="font-family:monospace;">{{ $appointment->invoice_number ?? 'Pending' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label">Booking Ref:</span>
                        <span class="info-row-value" style="font-family:monospace;">{{ $appointment->booking_number ?: $appointment->tracking_code }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label">Service Date:</span>
                        <span class="info-row-value">{{ $appointment->pref_date->format('M d, Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-row-label">Schedule Time:</span>
                        <span class="info-row-value">{{ \Carbon\Carbon::parse($appointment->pref_time)->format('h:i A') }}</span>
                    </div>
                </div>
            </div>

            {{-- Line-item table --}}
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th style="width:55%;">Service / Item Description</th>
                        <th style="width:20%; text-align:center;">Device</th>
                        <th style="width:25%; text-align:right;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong style="color:#1e293b;">{{ $appointment->fault_category }}</strong>
                            <div style="color:#64748b; font-size:10px; margin-top:2px;">Initial quote estimate & diagnostics assessment fee</div>
                        </td>
                        <td style="text-align:center; color:#475569;">
                            {{ $appointment->device_brand }}<br>
                            <span style="font-size:10px; color:#64748b;">{{ $appointment->device_model }}</span>
                        </td>
                        <td style="text-align:right; font-weight:bold; color:#1e293b;">
                            ₱{{ number_format($appointment->quote ?? 0, 2) }}
                        </td>
                    </tr>
                    @if(is_numeric($appointment->final_cost) && ($appointment->final_cost != $appointment->quote))
                    <tr>
                        <td>
                            <strong style="color:#1e293b;">Labor & Additional Repair Fees</strong>
                            <div style="color:#64748b; font-size:10px; margin-top:2px;">Cost adjustments during repair work</div>
                        </td>
                        <td style="text-align:center; color:#475569;">—</td>
                        <td style="text-align:right; font-weight:bold; color:#1e293b;">
                            ₱{{ number_format($appointment->final_cost - ($appointment->quote ?? 0), 2) }}
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>

            @if($appointment->description)
            <div class="desc-box">
                <div class="desc-header-invoice">Description of Issue</div>
                <div class="desc-content">{{ $appointment->description }}</div>
            </div>
            @endif

            @if($appointment->completion_notes)
            <div class="desc-box" style="background:#fffbeb; border-color:#fef3c7; border-left: 3px solid #d97706;">
                <div style="font-size:9px; font-weight:800; color:#b45309; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:6px;">Technician Notes</div>
                <div class="desc-content" style="color:#78350f;">{{ $appointment->completion_notes }}</div>
            </div>
            @endif

            <div class="pricing-area">
                <div class="pricing-row">
                    <span class="pricing-label">Subtotal</span>
                    <span class="pricing-val">₱{{ number_format($appointment->quote ?? 0, 2) }}</span>
                </div>
                @if(is_numeric($appointment->final_cost) && ($appointment->final_cost != $appointment->quote))
                <div class="pricing-row">
                    <span class="pricing-label">Adjustments</span>
                    <span class="pricing-val">₱{{ number_format($appointment->final_cost - $appointment->quote, 2) }}</span>
                </div>
                <div class="total-bar-invoice">
                    <span class="total-label">Total Amount Due</span>
                    <span class="total-val">₱{{ number_format($appointment->final_cost, 2) }}</span>
                </div>
                @else
                <div class="total-bar-invoice">
                    <span class="total-label">Estimated Total Due</span>
                    <span class="total-val">₱{{ number_format($appointment->quote ?? 0, 2) }}</span>
                </div>
                @endif
            </div>

            <div class="doc-footer">
                <div>Thank you for choosing RepairMax for your device repair needs!</div>
                <div>Document generated on {{ now()->format('M d, Y \a\t h:i A') }}</div>
                <div style="font-style:italic; margin-top: 2px;">This invoice is electronically generated and valid without signature.</div>
            </div>

        </div>
    </div>

    <script>
        function downloadAsHTML() {
            const html = document.documentElement.outerHTML;
            const blob = new Blob([html], { type: 'text/html' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'receipt-invoice-{{ $appointment->booking_number ?: $appointment->tracking_code }}.html';
            a.click();
            window.URL.revokeObjectURL(url);
        }
    </script>
</body>
</html>
