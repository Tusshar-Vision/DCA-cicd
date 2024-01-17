<div class="space-y-6">
    <div>
        <h1 class="text-lg font-bold">RELATED TERMS</h1>
    </div>

    <div class="space-y-4">
        @foreach($relatedTerms as $key => $relatedTerm)
            <div class="space-y-1">
                <div>
                    <h2 class="font-bold text-lg">{{ $relatedTerm->term->term }}</h2>
                </div>
                <div>
                    <p class="text-visionLineGray text-sm">
                        {{ $relatedTerm->term->description }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
