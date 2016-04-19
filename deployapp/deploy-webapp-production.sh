aws --version
aws configure set aws_access_key_id $AWSKEY
aws configure set aws_secret_access_key $AWSSECRETKEY
aws configure set default.region ap-southeast-1
aws configure set default.output json
# Empty manage.pathotrack.com & upload new files to manage.pathotrack.com
aws s3 rm s3://manage.pathotrack.com --recursive && aws s3 sync ../webapp/dist s3://manage.pathotrack.com --exclude 'res/*' --exclude 'spec/*' --exclude 'tests/*' --exclude '*.xml' --exclude 'icon.png' --exclude 'splash.png' --exclude 'spec.html' --exclude 'testem.js'
# Update phonegap build
zip -r ../webapp/dist/app.zip ../webapp/dist/* && curl -k -u maulik+pathotrack+production@skarma.com:SamplePass@123 -X PUT -d 'data={"key_pw":"SamplePass@123","keystore_pw":"SamplePass@123"}' https://build.phonegap.com/api/v1/keys/android/$phonegap_production_key_id && curl -k -u maulik+pathotrack+production@skarma.com:SamplePass@123 -X PUT -F file=@../webapp/dist/app.zip https://build.phonegap.com/api/v1/apps/$phonegap_production_app_id
# Create new application version on AWS EB application
aws configure set default.region us-east-1
cd ../api && zip -r pathotrack-$CIRCLE_BUILD_NUM-api.zip . -x './vendor/*' './node_modules/*' && aws s3 cp pathotrack-$CIRCLE_BUILD_NUM-api.zip s3://elasticbeanstalk-us-east-1-751832333305 && aws elasticbeanstalk create-application-version --application-name pathotrack --version-label $CIRCLE_BUILD_NUM --source-bundle S3Bucket=elasticbeanstalk-us-east-1-751832333305,S3Key=pathotrack-$CIRCLE_BUILD_NUM-api.zip && aws elasticbeanstalk update-environment --application-name pathotrack --environment-name pathotrack --version-label $CIRCLE_BUILD_NUM