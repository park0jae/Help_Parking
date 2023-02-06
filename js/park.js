

const contents = document.querySelector(".contents");
const buttons = document.querySelector(".buttons");

const numOfContent = 82;
const showContent = 10;
const showButton = 5;
const maxContent = 10;
const maxButton = 8;
const maxPage = Math.ceil(numOfContent / maxContent);
let page = 1;

// html 요소 넣기
        
const makeTitle = (id) => {
  const content = document.createElement("li");
  content.classList.add("content");
  content.innerHTML = `
    <span class="content__id" id="list">목록</span>
    <span class="content__name" id="list">주차장</span>
    <span class="content__size" id="list">면적</span>
    <span class="content__operatingtime" id="list">운영시간</span>
    <span class="content__fee" id="list">운영요금</span>
    <span class="content__address" id="list">주소</span>
    <span class="content__number" id="list">전화번호</span>
    <span class="content__paidfree" id="list">유료/무료 여부</span>
    `;
  return content;
};

        
const makeContent = (id) => {
  const content = document.createElement("li");
  content.classList.add("content");
  content.innerHTML = `
    <span class="content__id">${id}</span>
    <span class="content__name">오거리 주차장</span>
    <span class="content__size">198면</span>
    <span class="content__operatingtime">24시간(연중무휴)</span>
    <span class="content__fee">기본(30):600, 추가(15):300</span>
    <span class="content__address">전주시 완산구 팔달로 217-21</span>
    <span class="content__number">239-2768</span>
    <span class="content__paidfree">유료주차장</span>
    `;
  return content;
};

const makeButton = (id) => {
  const button = document.createElement("button");
  button.classList.add("button");
  button.dataset.num = id;
  button.innerText = id;
  button.addEventListener("click", (e) => {
    Array.prototype.forEach.call(buttons.children, (button) => {
      if (button.dataset.num) button.classList.remove("active");
    });
    e.target.classList.add("active");
    renderContent(parseInt(e.target.dataset.num));
  });
  return button;
};

// 글 목록 & 버튼 생성 함수 구현
const renderContent = (page) => {
  // 목록 리스트 초기화
  
  while (contents.hasChildNodes()) {
    contents.removeChild(contents.lastChild);
  }
  contents.appendChild(makeTitle());
  // 글의 최대 개수를 넘지 않는 선에서, 화면에 최대 10개의 글 생성
  for (let id = (page - 1) * maxContent + 1; id <= page * maxContent && id <= numOfContent; id++) {
    contents.appendChild(makeContent(id));
  }
};

// 렌더링 함수
const renderButton = (page) => {
  // 버튼 리스트 초기화
  while (buttons.hasChildNodes()) {
    buttons.removeChild(buttons.lastChild);
  }
  // 화면에 최대 5개의 페이지 버튼 생성
  for (let id = page; id < page + maxButton && id <= maxPage; id++) {
    buttons.appendChild(makeButton(id));
  }
  // 첫 버튼 활성화(class="active")
  buttons.children[0].classList.add("active");

  buttons.prepend(prev);
  buttons.append(next);

  // 이전, 다음 페이지 버튼이 필요한지 체크
  // if (page - maxButton < 1) buttons.removeChild(prev);
  // if (page + maxButton > maxPage) buttons.removeChild(next);
};


// 페이지 이동 함수 구현
const goPrevPage = () => {
  if(page == 1)
    render(page);
  else
  {
    page -= maxButton;
    render(page);
  }
};

const goNextPage = () => {
  if(page == 9)
    render(page);
  else
  {
    page += maxButton;
    render(page);
  }
};

const prev = document.createElement("button");
prev.classList.add("button", "prev");
prev.innerHTML = '<ion-icon name="chevron-back-outline"></ion-icon>';
prev.addEventListener("click", goPrevPage);


const next = document.createElement("button");
next.classList.add("button", "next");
next.innerHTML = '<ion-icon name="chevron-forward-outline"></ion-icon>';
next.addEventListener("click", goNextPage);

const render = (page) => {
  renderContent(page);
  renderButton(page);
};
render(page);



