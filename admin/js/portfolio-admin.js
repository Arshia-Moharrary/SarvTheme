(function () {
    'use strict';

    const list = document.getElementById('sarv-gallery-list');
    const addBtn = document.getElementById('sarv-add-images');
    if (!list || !addBtn) return;

    const TYPE_LABELS = {
        smile_portrait: 'پرترهٔ لبخند — 1:1',
        dental_closeup: 'نمای نزدیک دندان — 4:5',
        dental_square: 'نمای نزدیک مربع — 1:1',
        multi_tooth: 'مقایسهٔ چند دندان — 7:12',
        before_after: 'قبل/بعد طراحی‌شده — 197:350',
    };

    // ---------------- Add images via WP media modal ----------------
    let mediaFrame = null;

    addBtn.addEventListener('click', function (e) {
        e.preventDefault();

        if (!mediaFrame) {
            mediaFrame = wp.media({
                title: 'انتخاب تصاویر نمونه‌کار',
                button: { text: 'افزودن به گالری' },
                library: { type: 'image' },
                multiple: 'add',
            });

            mediaFrame.on('select', function () {
                mediaFrame.state().get('selection').each(function (attachment) {
                    const data = attachment.toJSON();
                    if (list.querySelector('.sarv-gallery-item[data-id="' + data.id + '"]')) return;
                    addRow(data);
                });
                renumber();
            });
        }

        mediaFrame.open();
    });

    function addRow(data) {
        const thumbUrl = data.sizes && data.sizes.thumbnail ? data.sizes.thumbnail.url : data.url;
        const li = document.createElement('li');
        li.className = 'sarv-gallery-item';
        li.dataset.id = data.id;
        li.draggable = true;

        li.innerHTML =
            '<span class="sarv-gallery-handle" title="جابه‌جایی">☰</span>' +
            '<img src="' + thumbUrl + '" class="sarv-gallery-thumb" alt="" draggable="false">' +
            '<select name="sarv_image_type[' + data.id + ']" class="sarv-gallery-type">' +
            Object.keys(TYPE_LABELS).map(function (key) {
                const selected = key === 'dental_square' ? ' selected' : '';
                return '<option value="' + key + '"' + selected + '>' + TYPE_LABELS[key] + '</option>';
            }).join('') +
            '</select>' +
            '<input type="hidden" name="sarv_image_order[' + data.id + ']" value="0" class="sarv-gallery-order">' +
            '<button type="button" class="sarv-gallery-remove" aria-label="حذف تصویر">×</button>';

        list.appendChild(li);
    }

    // ---------------- Remove ----------------
    list.addEventListener('click', function (e) {
        const btn = e.target.closest('.sarv-gallery-remove');
        if (!btn) return;
        btn.closest('.sarv-gallery-item').remove();
        renumber();
    });

    // ---------------- Drag & drop reorder ----------------
    let dragged = null;

    list.addEventListener('dragstart', function (e) {
        const item = e.target.closest('.sarv-gallery-item');
        if (!item) return;
        dragged = item;
        item.classList.add('is-dragging');
        e.dataTransfer.effectAllowed = 'move';
        // Required for Firefox to start drag
        e.dataTransfer.setData('text/plain', '');
    });

    list.addEventListener('dragover', function (e) {
        e.preventDefault();
        if (!dragged) return;
        const over = e.target.closest('.sarv-gallery-item');
        if (!over || over === dragged) return;
        const rect = over.getBoundingClientRect();
        const isTop = (e.clientY - rect.top) < rect.height / 2;
        list.insertBefore(dragged, isTop ? over : over.nextSibling);
    });

    list.addEventListener('dragend', function () {
        if (dragged) dragged.classList.remove('is-dragging');
        dragged = null;
        renumber();
    });

    // ---------------- Utilities ----------------
    function renumber() {
        list.querySelectorAll('.sarv-gallery-item').forEach(function (li, i) {
            const input = li.querySelector('.sarv-gallery-order');
            if (input) input.value = i;
        });
    }

    renumber();
})();