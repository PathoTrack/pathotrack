aws --version
aws configure set aws_access_key_id $AWSKEY
aws configure set aws_secret_access_key $AWSSECRETKEY
aws configure set default.region ap-southeast-1
aws configure set default.output json
# Empty manage.pathotrack.com & upload new files to manage.pathotrack.com
aws s3 rm s3://manage.pathotrack.com --recursive && aws s3 sync ../webapp/dist s3://manage.pathotrack.com --exclude 'res/*' --exclude 'spec/*' --exclude 'tests/*' --exclude '*.xml' --exclude 'icon.png' --exclude 'splash.png' --exclude 'spec.html' --exclude 'testem.js'
# Create new application version on AWS EB application
aws configure set default.region us-east-1
cd ../api && zip -r pathotrack-$CIRCLE_BUILD_NUM-api.zip . -x './vendor/*' './node_modules/*' && aws s3 cp pathotrack-$CIRCLE_BUILD_NUM-api.zip s3://elasticbeanstalk-us-east-1-751832333305 && aws elasticbeanstalk create-application-version --application-name pathotrack --version-label $CIRCLE_BUILD_NUM --source-bundle S3Bucket=elasticbeanstalk-us-east-1-751832333305,S3Key=pathotrack-$CIRCLE_BUILD_NUM-api.zip && aws elasticbeanstalk update-environment --application-name pathotrack --environment-name pathotrack --version-label $CIRCLE_BUILD_NUM