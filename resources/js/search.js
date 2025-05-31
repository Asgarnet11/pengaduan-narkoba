document.addEventListener('alpine:init', () => {
    Alpine.data('search', () => ({
        query: '',
        type: 'all',
        results: [],
        loading: false,
        showResults: false,

        async search() {
            if (this.query.length < 3) {
                this.results = [];
                this.showResults = false;
                return;
            }

            this.loading = true;
            this.showResults = true;

            try {
                const response = await fetch(`/search?q=${encodeURIComponent(this.query)}&type=${this.type}`);
                const data = await response.json();
                this.results = data;
            } catch (error) {
                console.error('Search error:', error);
                this.results = [];
            } finally {
                this.loading = false;
            }
        },

        getStatusColor(status) {
            const colors = {
                'pending': 'bg-gray-100 text-gray-800',
                'proses': 'bg-yellow-100 text-yellow-800',
                'selesai': 'bg-green-100 text-green-800',
                'ditolak': 'bg-red-100 text-red-800'
            };
            return colors[status] || colors.pending;
        },

        handleKeydown(event) {
            if (event.key === 'Escape') {
                this.showResults = false;
            }
        }
    }));
});
