const admin = require('firebase-admin');
const serviceAccount = require('./path/to/your/serviceAccountKey.json');

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount),
  databaseURL: 'https://your-project-id.firebaseio.com',
});

const firestore = admin.firestore();
const data = require('./interns_management.json');

data.forEach(async (doc) => {
  await firestore.collection('your-collection').add(doc);
});

console.log('Data imported successfully');
