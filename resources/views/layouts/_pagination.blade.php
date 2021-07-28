@if($pagination->hasPages())
    <div class="col-12">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{ $pagination->links() }}
            </ul>
        </nav>
    </div>
@endif
