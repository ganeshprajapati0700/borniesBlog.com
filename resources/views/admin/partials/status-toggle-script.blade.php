<script>
/**
 * Shared inline status toggle handler.
 * Sends a POST with CSRF token, updates the button appearance on success.
 */
function toggleStatus(btn) {
    const url    = btn.dataset.url;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
                   || '{{ csrf_token() }}';

    btn.disabled = true;
    btn.style.opacity = '0.6';

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
    })
    .then(res => {
        if (!res.ok) throw new Error('Request failed');
        return res.json();
    })
    .then(data => {
        const isActive = data.status == 1;
        const dot      = btn.querySelector('span.rounded-full');
        const label    = btn.querySelector('.label');

        // Determine label text based on context (posts use Published/Draft, others use Active/Inactive)
        const isPost = url.includes('/posts/');
        const activeLabel   = isPost ? 'Published' : 'Active';
        const inactiveLabel = isPost ? 'Draft'     : 'Inactive';

        btn.dataset.status = data.status;

        if (isActive) {
            btn.className = btn.className
                .replace(/bg-amber-50\s?/, '').replace(/text-amber-700\s?/, '').replace(/border-amber-200\s?/, '')
                .trim() + ' bg-emerald-50 text-emerald-700 border-emerald-200';
            dot.className = dot.className.replace('bg-amber-500', 'bg-emerald-500');
            label.textContent = activeLabel;
        } else {
            btn.className = btn.className
                .replace(/bg-emerald-50\s?/, '').replace(/text-emerald-700\s?/, '').replace(/border-emerald-200\s?/, '')
                .trim() + ' bg-amber-50 text-amber-700 border-amber-200';
            dot.className = dot.className.replace('bg-emerald-500', 'bg-amber-500');
            label.textContent = inactiveLabel;
        }
    })
    .catch(() => {
        alert('Failed to update status. Please try again.');
    })
    .finally(() => {
        btn.disabled = false;
        btn.style.opacity = '1';
    });
}
</script>
