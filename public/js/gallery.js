// ===== GALLERY FUNCTIONALITY =====
    let currentGalleryIndex = 0;
    let filteredGalleries = [...galleries];

    // Open Modal
    function openModal(index) {
        currentGalleryIndex = index;
        const modal = document.getElementById('galleryModal');
        const img = document.getElementById('galleryModalImg');
        const counter = document.getElementById('galleryCounter');
        const title = document.getElementById('modalTitle');
        const category = document.getElementById('modalCategory');
        
        if (!modal || !img || !counter) return;
        
        modal.classList.add('active');
        img.src = galleries[index].image;
        img.alt = galleries[index].title;
        title.textContent = galleries[index].title;
        category.textContent = galleries[index].category;
        counter.textContent = `${index + 1} / ${galleries.length}`;
        
        document.body.classList.add('modal-open');
    }

    // Close Modal
    function closeGalleryModal() {
        const modal = document.getElementById('galleryModal');
        if (!modal) return;
        
        modal.classList.remove('active');
        document.body.classList.remove('modal-open');
    }

    // Change Gallery (Previous/Next)
    function changeGallery(direction) {
        currentGalleryIndex += direction;
        
        if (currentGalleryIndex < 0) {
            currentGalleryIndex = galleries.length - 1;
        } else if (currentGalleryIndex >= galleries.length) {
            currentGalleryIndex = 0;
        }
        
        const img = document.getElementById('galleryModalImg');
        const counter = document.getElementById('galleryCounter');
        const title = document.getElementById('modalTitle');
        const category = document.getElementById('modalCategory');
        
        if (!img || !counter) return;
        
        // Smooth transition
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.2s ease';
        
        setTimeout(() => {
            img.src = galleries[currentGalleryIndex].image;
            img.alt = galleries[currentGalleryIndex].title;
            title.textContent = galleries[currentGalleryIndex].title;
            category.textContent = galleries[currentGalleryIndex].category;
            counter.textContent = `${currentGalleryIndex + 1} / ${galleries.length}`;
            img.style.opacity = '1';
        }, 200);
    }

    // Keyboard Navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('galleryModal');
        if (modal && modal.classList.contains('active')) {
            if (e.key === 'ArrowLeft') changeGallery(-1);
            if (e.key === 'ArrowRight') changeGallery(1);
            if (e.key === 'Escape') closeGalleryModal();
        }
    });

    // Close modal when clicking outside
    const galleryModal = document.getElementById('galleryModal');
    if (galleryModal) {
        galleryModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeGalleryModal();
            }
        });
    }

    // Prevent body scroll when modal is open
    document.getElementById('galleryModal').addEventListener('wheel', function(e) {
        e.preventDefault();
    }, { passive: false });