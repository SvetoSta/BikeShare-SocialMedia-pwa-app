const wakeLockSwitch = document.querySelector('#wake-lock');

let wakeLock = null;

const requestWakeLock = async () => {
  try {
    wakeLock = await navigator.wakeLock.request('screen');

    wakeLock.addEventListener('release', () => {
      console.log('Wake Lock was released');
    });
    console.log('Wake Lock is active');
  }
  catch(err) {
    console.error(`${err.name}, ${err.message}`);
  }
};

const releaseWakeLock = () => {
  console.log('releasing Wake-Lock');

  wakeLock.release();
  wakeLock = null;
};

wakeLockSwitch.addEventListener('change', (detail) => {
    if (detail.target.checked)
    {
      requestWakeLock();
    }else{
      releaseWakeLock();
    } 
  });      
    