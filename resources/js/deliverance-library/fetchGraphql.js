import fetch from 'cross-fetch'
import auth from './authorization'

export default function (query, actions) {

    actions.pending(query.variables)
   
    return fetch('/graphql', {
      method: "POST",
      body: JSON.stringify(query),
      headers: {
          'Accept': 'application/json',
          'Content-Type': "application/json",
          'Authorization': "Bearer " + auth.token(),
          'X-Requested-With': 'XMLHttpRequest'
      }
  })
      .then(res => {
        if (res.status >= 400) {
          throw new Error("Bad response from server");
        }
        return res.json();
      })
      .then(payload => {
          if (payload[0] !== undefined && payload[0].errors !== undefined) {
              actions.error(payload[0].errors);
          } else {
              actions.success(payload.data);
          }
      })
      .catch(err => {
          actions.error([err]);
      });
    }
