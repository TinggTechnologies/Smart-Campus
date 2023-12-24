window.onload = () => {
    $('.slider').click(function(){
        $(".menu-dropdown").toggleClass("active");
    });

    $('.settings-dropper').click(function(){
        $(".setting-dropdown").toggleClass("active");
    });

    $('.profile-dropper').click(function(){
        $(".profile-dropdown").toggleClass("active");
    });

    $('.post-dropper').click(function(){
        $(".post-dropdown").toggleClass("active");
    });


    // Handling open and close create post fullscreen
    let openCreatePost = document.querySelector('.open-create-post');
    let closeCreatePost = document.querySelector('.close-create-post');
    let expandCreatePost = document.querySelector('.expand-create-post');

    openCreatePost.onclick = () => {
        expandCreatePost.style.display = 'block';
    }
    closeCreatePost.onclick = () => {
        expandCreatePost.style.display = 'none';
    }

    // Handling open and close Search Page fullscreen
    let openSearchBox = document.querySelector('.open-search-box');
    let closeSearchBox = document.querySelector('.close-search-box');
    let expandSearchBox = document.querySelector('.expand-search-box');

    openSearchBox.onclick = () => {
        expandSearchBox.style.display = 'block';
    }
    closeSearchBox.onclick = () => {
        expandSearchBox.style.display = 'none';
    }

    // Handling opening and close feed post expand action box
    let openExpandAction = document.querySelector('.open-expand-action-box');
    let expandActionBox = document.querySelector('.expand-action-box');
    let closeExpandAction = document.querySelector('.close-expand-action-box');
    openExpandAction.onclick = () => {
        expandActionBox.classList.add('active');
    }
    closeExpandAction.onclick = () => {
        expandActionBox.classList.remove('active');
    }


    
// Get all the open comment buttons
let openCommentButtons = document.querySelectorAll('.open-comment');

// Attach event listener to each open comment button
openCommentButtons.forEach(openButton => {
    openButton.addEventListener('click', () => {
        // Find the associated comment box
        let commentBox = openButton.closest('.comments-box');

        // Add the 'active' class to show the comment box
        commentBox.classList.add('active');
    });
});

// Get all the close comment buttons
let closeCommentButtons = document.querySelectorAll('.close-comment');

// Attach event listener to each close comment button
closeCommentButtons.forEach(closeButton => {
    closeButton.addEventListener('click', () => {
        // Find the associated comment box
        let commentBox = closeButton.closest('.comments-box');

        // Remove the 'active' class to hide the comment box
        commentBox.classList.remove('active');
    });
});



    // ======================================= Profile Function ===================================
    const switchBtn1 = document.querySelector('.switch-btn1');
    const switchBtn2 = document.querySelector('.switch-btn2');
    const switchBtn3 = document.querySelector('.switch-btn3');

    const postWrapperTab = document.querySelector('.post-wrapper-tab');
    const mediaWrapperTab = document.querySelector('.media-wrapper-tab');
    const pdfWrapperTab = document.querySelector('.pdf-wrapper-tab');

    const switchProfileTabs = document.querySelectorAll('.switch-profile-tabs');

    // Remove active class from all menu items
    const changeActiveItem = () => {
        switchProfileTabs.forEach(item => {
            item.classList.remove('is-active');
        })
    }

    switchProfileTabs.forEach(item => {
        item.addEventListener('click', () => {
            changeActiveItem();
            item.classList.add('is-active');
        })
    })

    switchBtn1.addEventListener('click', () => {
        postWrapperTab.style.display = 'block';
        mediaWrapperTab.style.display = 'none';
        pdfWrapperTab.style.display = 'none';
    })
    switchBtn2.addEventListener('click', () => {
        postWrapperTab.style.display = 'none';
        mediaWrapperTab.style.display = 'block';
        pdfWrapperTab.style.display = 'none';
    })
    switchBtn3.addEventListener('click', () => {
        postWrapperTab.style.display = 'none';
        mediaWrapperTab.style.display = 'none';
        pdfWrapperTab.style.display = 'block';
    })

    const pdfTabBtn1 = document.querySelector('.pdf-tab-btn1');
    const pdfTabBtn2 = document.querySelector('.pdf-tab-btn2');

    const donatedPage = document.querySelector('.donated-page');
    const downloadedPage = document.querySelector('.downloaded-page');

    const switchTab = document.querySelectorAll('.switch-pdf-tab');

    // Remove active class from all menu items
    const changeActiveItem1 = () => {
        switchTab.forEach(item => {
            item.classList.remove('is-active');
        })
    }

    switchTab.forEach(item => {
        item.addEventListener('click', () => {
            changeActiveItem1();
            item.classList.add('is-active');
        })
    })

    pdfTabBtn1.addEventListener('click', () => {
        donatedPage.style.display = 'block';
        downloadedPage.style.display = 'none';
    })
    pdfTabBtn2.addEventListener('click', () => {
        donatedPage.style.display = 'none';
        downloadedPage.style.display = 'block';
    })

    // Friend List
    const followersTab = document.querySelector('.followers-tab');
    const followingTab = document.querySelector('.following-tab');

    const followersPage = document.querySelector('.followers-page');
    const followingPage = document.querySelector('.following-page');

    const switchFriendlistTab = document.querySelectorAll('.switch-friendlist-tab');

    // Remove active class from all menu items
    const changeActiveItem2 = () => {
        switchFriendlistTab.forEach(item => {
            item.classList.remove('active');
        })
    }

    switchFriendlistTab.forEach(item => {
        item.addEventListener('click', () => {
            changeActiveItem2();
            item.classList.add('active');
        })
    })

    followersTab.addEventListener('click', () => {
        console.log("btn1 clicked")
        followersPage.style.display = 'block';
        followingPage.style.display = 'none';
    })
    followingTab.addEventListener('click', () => {
        console.log("btn2 clicked")
        followersPage.style.display = 'none';
        followingPage.style.display = 'block';
    })
    
} // End Window.onload