import React, { useRef } from 'react';
import emailjs from '@emailjs/browser';

export const ContactUs = () => {
  const form = useRef();

  const sendEmail = (e) => {
    e.preventDefault();

    emailjs.sendForm('YOUR_SERVICE_ID', 'YOUR_TEMPLATE_ID', form.current, 'PY1E6xKU4CT1POj8W')
      .then((result) => {
          console.log(result.text);
      }, (error) => {
          console.log(error.text);
      });
  };

  return (
    <form ref={form} onSubmit={sendEmail}>
      <label>Nome: </label>
      <input type="text" name="user_name" />
      <br/><br/>
      <label>Email: </label>
      <input type="email" name="user_email" />
      <br/><br/>
      <label>Messaggio: </label>
      <textarea name="message" />
      <br/><br/>
      <input type="submit" value="Invia" />
    </form>
  );
};

export default ContactUs;