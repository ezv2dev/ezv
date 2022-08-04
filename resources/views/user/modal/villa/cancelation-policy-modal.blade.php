<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-show_cancelationpolicy" tabindex="-1" role="dialog"
    aria-labelledby="modal-default-fadein" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding: 1rem 2rem !important;">
                <h5 class="modal-title">Cancelation Policy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 1rem 2rem 2rem 2rem !important;" id="modalDescriptionVilla">
                <h5>{{ $villa[0]->name }}</h5>
                @if ($cancellation_policy->type_cancellation == 'flexible')
                    <b>Flexible</b>
                    <p>Full refund 1 day prior to arrival</p>
                @elseif ($cancellation_policy->type_cancellation == 'flexible_non_refund')
                    <b>Flexible Non Refund</b>
                    <p>In addition to Flexible, offer a non-refundable option—guests pay 10% less, but you keep your
                        payout no matter when they cancel.</p>
                @elseif ($cancellation_policy->type_cancellation == 'moderate')
                    <b>Moderate</b>
                    <p>Full refund 5 days prior to arrival</p>
                @elseif ($cancellation_policy->type_cancellation == 'moderate_non_refund')
                    <b>Moderate Non Refund</b>
                    <p>In addition to Moderate, offer a non-refundable option—guests pay 10% less, but you keep your
                        payout no matter when they cancel.</p>
                @elseif ($cancellation_policy->type_cancellation == 'firm')
                    <b>Firm</b>
                    <p>Full refund for cancellations up to 30 days before check-in. If booked fewer than 30 days before
                        check-in, full refund for cancellations made within 48 hours of booking and at least 14 days
                        before check-in. After that, 50% refund up to 7 days before check-in. No refund after that.</p>
                @elseif ($cancellation_policy->type_cancellation == 'firm_non_refund')
                    <b>Firm Non Refund</b>
                    <p>In addition to Firm, offer a non-refundable option—guests pay 10% less, but you keep your payout
                        no matter when they cancel.</p>
                @elseif ($cancellation_policy->type_cancellation == 'strict')
                    <b>Strict</b>
                    <p>Full refund for cancellations made within 48 hours of booking, if the check-in date is at least
                        14 days away. 50% refund for cancellations made at least 7 days before check-in. No refunds for
                        cancellations made within 7 days of check-in.</p>
                @elseif ($cancellation_policy->type_cancellation == 'strict_non_refund')
                    <b>Strict Non Refud</b>
                    <p>In addition to Strict, offer a non-refundable option—guests pay 10% less, but you keep your
                        payout no matter when they cancel.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
