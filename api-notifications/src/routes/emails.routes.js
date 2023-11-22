const { Router } = require("express");
const {
  sendEmail,
  addEmailToQueue,
  addListEmailsToQueue,
  dispatchEmails,
  addEmailsToQueueFromCsv,
} = require("../app/controllers/emails/v1/emails.controller.js");

const {
  sendEmailFromTemplate,
  addEmailToQueueFromTemplate,
  addListEmailsToQueueFromTemplate,
  addEmailsToQueueFromCsvFromTemplate,
} = require("../app/controllers/emails/v2/emails.controller.js");

const router = Router();

router.post("/", (req, res) => {
  return res.json({
    message: "Active",
  });
});

// V1 it's needed to pass template as a parameter
router.post("/v1/sendEmail", sendEmail);
router.post("/v1/addEmailToQueue", addEmailToQueue);
router.post("/v1/addListEmailsToQueue", addListEmailsToQueue);
router.post("/v1/dispatchEmails", dispatchEmails);
router.post("/v1/addEmailsToQueueFromCsv", addEmailsToQueueFromCsv);

// V2 use templates to send emails
router.post("/v2/sendEmail", sendEmailFromTemplate);
router.post("/v2/addEmailToQueue", addEmailToQueueFromTemplate);
router.post("/v2/addListEmailsToQueue", addListEmailsToQueueFromTemplate);
router.post("/v2/addEmailsToQueueFromCsv", addEmailsToQueueFromCsvFromTemplate);

module.exports = router;
