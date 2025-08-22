# Environment Variables Reference

**Last updated:** December 2024

This document provides a comprehensive reference for all environment variables required by the Modern Agent application.

## 📋 **Quick Setup**

1. Copy `.env.example` to `.env` in your project root
2. Fill in the required values using this reference
3. Restart your web server after making changes

## 🔧 **Complete Environment Variables List**

### **Database Configuration**
```env
# Database connection settings
DB_HOST=localhost
DB_NAME=modern_agent
DB_USER=your_database_username
DB_PASS=your_database_password
DB_PORT=3306
```

### **External API Keys**

#### **OpenAI Integration**
```env
# Required for AI-powered market analysis
CHAT_GPT_API_KEY=sk-your_openai_api_key_here
CHAT_GPT_URL=https://api.openai.com/v1/chat/completions
```

#### **SiteX Data API**
```env
# Property data and market information
SITEX_API=your_sitex_api_key_here
SITEX_API_ENDPOINT=https://api.sitexdata.com/187/
```

#### **Google Maps API**
```env
# For map integration and geocoding
GOOGLE_MAPS_API_KEY=your_google_maps_api_key_here
```

#### **Stripe Payment Processing**
```env
# Payment processing (choose mode)
STRIPE_MODE=sandbox
# OR
STRIPE_MODE=live

# Sandbox keys (for testing)
STRIPE_KEY_SANDBOX=pk_test_your_sandbox_publishable_key
STRIPE_KEY_SECRET_SANDBOX=sk_test_your_sandbox_secret_key

# Live keys (for production)
STRIPE_KEY_LIVE=pk_live_your_live_publishable_key
STRIPE_KEY_SECRET_LIVE=sk_live_your_live_secret_key
```

#### **Twilio SMS Integration**
```env
# SMS notifications and communication
TWILIO_ACCOUNT_SID=your_twilio_account_sid
TWILIO_AUTH_TOKEN=your_twilio_auth_token
TWILIO_PHONE_NUMBER=+1234567890
```

### **PDF Generation Tools**

#### **wkhtmltopdf Configuration**
```env
# Primary PDF generation engine
WKHTMLTOPDF_PATH=/usr/local/bin/wkhtmltopdf
# Windows: C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe
# macOS: /usr/local/bin/wkhtmltopdf
# Linux: /usr/bin/wkhtmltopdf
```

#### **qpdf Configuration**
```env
# PDF optimization and merging
QPDF_PATH=/usr/local/bin/qpdf
# Windows: C:\Program Files\qpdf\bin\qpdf.exe
# macOS: /usr/local/bin/qpdf
# Linux: /usr/bin/qpdf
```

### **Application Settings**
```env
# Base application URL (no trailing slash)
BASE_URL=https://yourdomain.com

# Environment mode
ENVIRONMENT=production
# OR
ENVIRONMENT=development

# Widget domain for CORS
WIDGET_DOMAIN=yourdomain.com
```

### **Email Configuration**
```env
# SMTP settings for outgoing emails
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=your_email@gmail.com
SMTP_PASS=your_app_password
SMTP_ENCRYPTION=tls
```

### **File Storage & Caching**
```env
# File upload limits (in MB)
MAX_FILE_SIZE=50

# Cache settings
CACHE_ENABLED=true
CACHE_TTL=3600

# Temporary file cleanup
TEMP_FILE_CLEANUP=true
```

### **Security Settings**
```env
# Session configuration
SESSION_TIMEOUT=7200
SESSION_SECURE=true

# API rate limiting
API_RATE_LIMIT=100
API_RATE_WINDOW=3600
```

### **Development & Debugging**
```env
# Only for development environments
DEBUG_MODE=false
LOG_LEVEL=error
PROFILER_ENABLED=false
```

## 🔍 **Variable Details & How to Obtain**

### **Database Variables**
- **Purpose**: Connect to your MySQL/MariaDB database
- **Setup**: Create database and user through your hosting control panel
- **Required**: All database variables are mandatory

### **OpenAI API Key**
- **Purpose**: Powers AI market analysis features
- **How to get**: 
  1. Sign up at [OpenAI Platform](https://platform.openai.com)
  2. Go to API Keys section
  3. Create new secret key
  4. Copy the key (starts with `sk-`)
- **Cost**: ~$20/month for typical usage

### **SiteX Data API**
- **Purpose**: Property data and comparable sales
- **How to get**: Contact SiteX Data directly for API access
- **Note**: Code expects `SITEX_API` (not `SITEX_API_KEY`)

### **Google Maps API Key**
- **Purpose**: Map display and geocoding services
- **How to get**:
  1. Go to [Google Cloud Console](https://console.cloud.google.com)
  2. Create project and enable Maps JavaScript API
  3. Create credentials → API Key
  4. Restrict key to your domain
- **Cost**: Free tier available, then pay-per-use

### **Stripe Keys**
- **Purpose**: Payment processing for subscriptions
- **How to get**:
  1. Sign up at [Stripe Dashboard](https://dashboard.stripe.com)
  2. Get test keys from Developers → API Keys
  3. For live keys, complete account verification
- **Security**: Never commit live keys to version control

### **Twilio Credentials**
- **Purpose**: SMS notifications and two-factor authentication
- **How to get**:
  1. Sign up at [Twilio Console](https://console.twilio.com)
  2. Get Account SID and Auth Token from dashboard
  3. Purchase phone number for sending SMS
- **Cost**: Pay-per-message pricing

### **PDF Tool Paths**
- **Purpose**: Generate and optimize PDF reports
- **Installation**: See [HTML_TO_PDF_PROCESS.md](HTML_TO_PDF_PROCESS.md) for OS-specific instructions
- **Verification**: Run `wkhtmltopdf --version` and `qpdf --version` to test

## ⚠️ **Security Best Practices**

1. **Never commit `.env` to version control**
2. **Use different keys for development/production**
3. **Restrict API keys to specific domains/IPs when possible**
4. **Regularly rotate sensitive credentials**
5. **Use environment-specific values**

## 🚨 **Common Issues**

### **Database Connection Failed**
- Check `DB_HOST`, `DB_USER`, `DB_PASS` values
- Verify database exists and user has permissions
- Test connection with MySQL client

### **API Keys Not Working**
- Ensure no extra spaces in `.env` file
- Check API key format (OpenAI starts with `sk-`, Stripe with `pk_` or `sk_`)
- Verify API quotas and billing status

### **PDF Generation Errors**
- Check tool paths are correct for your OS
- Verify binaries are executable: `chmod +x /path/to/binary`
- Test tools directly: `wkhtmltopdf --version`

### **CORS Issues**
- Set `WIDGET_DOMAIN` to match your actual domain
- Don't include `http://` or `https://` in `WIDGET_DOMAIN`
- Check browser console for specific CORS errors

## 📝 **Example .env File**

```env
# Database
DB_HOST=localhost
DB_NAME=modern_agent
DB_USER=ma_user
DB_PASS=secure_password_123

# APIs
CHAT_GPT_API_KEY=sk-1234567890abcdef1234567890abcdef
SITEX_API=your_sitex_key_here
GOOGLE_MAPS_API_KEY=AIzaSyC1234567890abcdef1234567890abcdef

# Stripe (sandbox mode)
STRIPE_MODE=sandbox
STRIPE_KEY_SANDBOX=pk_test_1234567890abcdef
STRIPE_KEY_SECRET_SANDBOX=sk_test_1234567890abcdef

# PDF Tools (Linux/macOS)
WKHTMLTOPDF_PATH=/usr/local/bin/wkhtmltopdf
QPDF_PATH=/usr/local/bin/qpdf

# Application
BASE_URL=https://modernagent.example.com
ENVIRONMENT=production
WIDGET_DOMAIN=modernagent.example.com
```

## 🔗 **Related Documentation**

- [DEPLOYMENT_GUIDE.md](DEPLOYMENT_GUIDE.md) - Full deployment instructions
- [HTML_TO_PDF_PROCESS.md](HTML_TO_PDF_PROCESS.md) - PDF tool installation
- [API_INTEGRATION_GUIDE.md](API_INTEGRATION_GUIDE.md) - API usage examples
