# Modern Agent Repository - Non-Technical Deployment Guide

## 🎯 **Overview**

This guide will help you deploy the Modern Agent real estate report generation system even if you don't have technical experience. We'll walk through each step with clear instructions and provide troubleshooting help along the way.

## 📋 **What You'll Need**

### **Required Services**
- **Web Hosting** - A server to run your application (we'll recommend options)
- **Domain Name** - A web address for your application (optional but recommended)
- **Database** - MySQL database for storing data
- **SSL Certificate** - For secure HTTPS connections (usually free)

### **Required API Keys** (You'll need to sign up for these)
- **OpenAI API Key** - For AI-powered market analysis ($20/month recommended)
- **SiteX Data API** - For property information (contact them for pricing)
- **Google Maps API** - For location services (free tier available)

### **Estimated Costs**
- **Web Hosting**: $20-50/month (VPS recommended)
- **Domain**: $10-15/year
- **OpenAI API**: $20-50/month (usage-based)
- **SSL Certificate**: Free (Let's Encrypt)
- **Total**: ~$40-100/month

## 🚀 **Step 1: Choose Your Hosting Solution**

### **Recommended Hosting Providers**

#### **Option A: DigitalOcean (Recommended)**
- **Why**: Reliable, good documentation, developer-friendly
- **Cost**: $20-40/month
- **Setup**: One-click WordPress/PHP application
- **Pros**: Excellent uptime, fast support, scalable
- **Cons**: Requires some technical setup

#### **Option B: Hostinger**
- **Why**: Budget-friendly, good for beginners
- **Cost**: $15-25/month
- **Setup**: cPanel interface
- **Pros**: Very affordable, user-friendly interface
- **Cons**: Less control, may have performance limitations

#### **Option C: SiteGround**
- **Why**: Excellent support, WordPress optimized
- **Cost**: $25-45/month
- **Setup**: Easy cPanel setup
- **Pros**: Outstanding customer support, reliable
- **Cons**: More expensive, renewal price increases

### **What You Need From Your Host**
- **PHP 7.4 or higher**
- **MySQL 5.7 or higher**
- **At least 2GB RAM**
- **SSL certificate support**
- **Command line access (SSH)**
- **Composer support**

## 🛠️ **Step 2: Set Up Your Domain**

### **2.1 Purchase a Domain**
1. Go to **Namecheap**, **GoDaddy**, or **Google Domains**
2. Search for your desired domain name
3. Purchase the domain (usually $10-15/year)
4. Note down your domain registrar login information

### **2.2 Connect Domain to Hosting**
1. **Log into your hosting account**
2. **Find the "DNS" or "Nameservers" section**
3. **Copy the nameserver addresses** (usually 2-4 addresses like `ns1.yourhost.com`)
4. **Log into your domain registrar**
5. **Update nameservers** to point to your hosting provider
6. **Wait 24-48 hours** for DNS propagation

## 📊 **Step 3: Set Up Database**

### **3.1 Create MySQL Database**
1. **Log into your hosting control panel** (cPanel, Plesk, etc.)
2. **Find "MySQL Databases" or "Database"**
3. **Create a new database** - name it `modern_agent`
4. **Create a database user** - choose a secure username and password
5. **Grant all privileges** to the user for the database
6. **Write down these details:**
   ```
   Database Name: modern_agent
   Database User: [your_username]
   Database Password: [your_password]
   Database Host: localhost (usually)
   ```

### **3.2 Import Database Structure**
1. **Find phpMyAdmin** in your control panel
2. **Select your database** from the left sidebar
3. **Click "Import" tab**
4. **Upload the database file** (we'll provide this)
5. **Click "Go" to import**

## 🔑 **Step 4: Get Your API Keys**

### **4.1 OpenAI API Key**
1. **Go to [platform.openai.com](https://platform.openai.com)**
2. **Create an account** or log in
3. **Go to API Keys section**
4. **Create a new secret key**
5. **Copy and save the key** (you won't see it again)
6. **Add billing information** and set usage limits

### **4.2 Google Maps API Key**
1. **Go to [Google Cloud Console](https://console.cloud.google.com)**
2. **Create a new project** or select existing
3. **Enable the Maps JavaScript API**
4. **Go to Credentials → Create Credentials → API Key**
5. **Restrict the key** to your domain for security
6. **Copy the API key**

### **4.3 SiteX Data API**
1. **Contact SiteX Data** for API access
2. **Provide your use case** (real estate report generation)
3. **Get your API endpoint and credentials**
4. **Test the connection** with their sample data

## 📁 **Step 5: Upload Your Files**

### **5.1 Download the Application**
1. **Download the Modern Agent application** files
2. **Extract the ZIP file** to your computer
3. **You should see folders like**: `application`, `assets`, `system`, etc.

### **5.2 Upload Files to Server**
1. **Access your hosting file manager** or use FTP client like FileZilla
2. **Navigate to your domain's public folder** (usually `public_html` or `www`)
3. **Upload all application files** to this folder
4. **Set correct file permissions**:
   - **Folders**: 755
   - **Files**: 644
   - **temp/ folder**: 777 (writeable)
   - **cache/ folder**: 777 (writeable)

### **5.3 Set Up Environment File**
1. **Find the file named `.env.example`**
2. **Copy it and rename to `.env`**
3. **Edit the .env file** with your information:

```env
# Database Settings
DB_HOST=localhost
DB_NAME=modern_agent
DB_USER=[your_database_username]
DB_PASS=[your_database_password]

# API Keys
CHAT_GPT_API_KEY=[your_openai_api_key]
CHAT_GPT_URL=https://api.openai.com/v1/chat/completions
GOOGLE_MAPS_API_KEY=[your_google_maps_key]

# SiteX Data API (get from provider)
SITEX_API_ENDPOINT=[provided_by_sitex]
SITEX_API_KEY=[provided_by_sitex]

# Application Settings
BASE_URL=https://yourdomain.com/
ENVIRONMENT=production
```

## 🔧 **Step 6: Install Dependencies**

### **6.1 Install Composer (if not available)**
1. **Check if Composer is installed** by running in your hosting terminal:
   ```bash
   composer --version
   ```
2. **If not installed, ask your hosting provider** to install it
3. **Or follow their Composer installation guide**

### **6.2 Install Application Dependencies**
1. **Navigate to your application folder** in terminal
2. **Run the installation command**:
   ```bash
   composer install --no-dev
   ```
3. **Wait for installation to complete** (may take 5-10 minutes)

### **6.3 Install PDF Tools**
1. **Check if wkhtmltopdf is installed**:
   ```bash
   which wkhtmltopdf
   ```
2. **If not installed, contact your hosting provider** to install:
   - wkhtmltopdf
   - qpdf (for PDF merging)
3. **Update your .env file** with the correct paths

## 🔒 **Step 7: Security Setup**

### **7.1 SSL Certificate**
1. **Check if your host provides free SSL** (most do via Let's Encrypt)
2. **Enable SSL in your hosting control panel**
3. **Force HTTPS redirects**
4. **Verify SSL works** by visiting `https://yourdomain.com`

### **7.2 File Permissions**
1. **Set correct permissions** on important files:
   ```bash
   chmod 644 .env
   chmod 755 application/
   chmod 777 temp/
   chmod 777 cache/
   ```
2. **Hide sensitive files** by creating `.htaccess`:
   ```apache
   <Files ".env">
   Order allow,deny
   Deny from all
   </Files>
   ```

### **7.3 Create Admin User**
1. **Access your application** at `https://yourdomain.com`
2. **Register the first user** (this becomes admin)
3. **Set a strong password**
4. **Save login credentials securely**

## ✅ **Step 8: Test Your Installation**

### **8.1 Basic Functionality Test**
1. **Visit your website**: `https://yourdomain.com`
2. **Check if the homepage loads** without errors
3. **Try logging in** with your admin account
4. **Navigate through the dashboard**

### **8.2 PDF Generation Test**
1. **Create a test report** using sample data
2. **Check if PDF generates successfully**
3. **Download and review the PDF**
4. **Verify all sections are present**

### **8.3 API Test**
1. **Test the API endpoint**:
   ```bash
   curl -X POST https://yourdomain.com/api/report/generateReport \
     -H "Content-Type: application/json" \
     -d '{"token":"test_token","test":"true"}'
   ```
2. **Check for proper response**

## 🔧 **Step 9: Configuration & Customization**

### **9.1 Basic Settings**
1. **Log into your admin panel**
2. **Go to Settings/Configuration**
3. **Set up**:
   - Company information
   - Default report themes
   - Email settings
   - User permissions

### **9.2 Upload Your Branding**
1. **Prepare your logo files** (PNG format, 300x100px recommended)
2. **Upload to**: `assets/images/`
3. **Update configuration** to use your logos

### **9.3 Email Configuration**
1. **Set up SMTP settings** for report delivery
2. **Test email sending** with a sample report
3. **Configure email templates** if needed

## 🚨 **Troubleshooting Common Issues**

### **Issue: "500 Internal Server Error"**
**Possible Causes:**
- Incorrect file permissions
- Missing .env file
- Database connection failure

**Solutions:**
1. **Check error logs** in your hosting control panel
2. **Verify .env file** has correct database credentials
3. **Set correct file permissions** (folders: 755, files: 644)
4. **Contact hosting support** if needed

### **Issue: "PDF Generation Failed"**
**Possible Causes:**
- Missing wkhtmltopdf installation
- Insufficient memory limits
- File permission issues

**Solutions:**
1. **Ask hosting provider to install wkhtmltopdf**
2. **Increase PHP memory limit** to 512M
3. **Set temp/ folder to 777 permissions**
4. **Check PHP error logs** for specific errors

### **Issue: "External API Timeout"**
**Possible Causes:**
- Incorrect API keys
- Network firewall issues
- API rate limits exceeded

**Solutions:**
1. **Verify all API keys** in .env file
2. **Check API quotas** and usage limits
3. **Contact API providers** for support
4. **Ask hosting provider** about firewall rules

### **Issue: "Database Connection Failed"**
**Possible Causes:**
- Wrong database credentials
- Database server down
- Hosting configuration issue

**Solutions:**
1. **Double-check database credentials** in .env
2. **Test database connection** via phpMyAdmin
3. **Contact hosting support** for database issues
4. **Verify database user permissions**

## 📞 **Getting Help**

### **When to Contact Hosting Support**
- Server configuration issues
- Installing server software (wkhtmltopdf, etc.)
- Database problems
- SSL certificate setup
- File permission issues

### **When to Contact Application Support**
- Application-specific errors
- Custom feature requests
- API integration issues
- Performance optimization
- Report template customization

### **What Information to Provide**
1. **Your domain name**
2. **Hosting provider and plan**
3. **Error messages** (exact text)
4. **Steps to reproduce** the issue
5. **Browser and device** you're using
6. **Screenshots** if applicable

## 📈 **Ongoing Maintenance**

### **Weekly Tasks**
- **Check error logs** for any issues
- **Monitor disk space** usage
- **Review API usage** and costs
- **Test report generation** with sample data

### **Monthly Tasks**
- **Update application** if new version available
- **Backup database** and files
- **Review security logs**
- **Monitor performance** metrics

### **Quarterly Tasks**
- **Review API costs** and usage patterns
- **Update SSL certificates** (if not automatic)
- **Optimize database** performance
- **Update documentation** and processes

## 🎉 **Congratulations!**

You've successfully deployed the Modern Agent application! Your real estate report generation system is now live and ready to create professional PDF reports for your clients.

### **Next Steps**
1. **Train your team** on using the system
2. **Create your first client reports**
3. **Set up automated backups**
4. **Monitor system performance**
5. **Plan for scaling** as usage grows

### **Support Resources**
- **Documentation**: Check the other guides in the `/docs/` folder
- **Community**: Join our user community for tips and support
- **Professional Support**: Contact us for dedicated technical support
- **Training**: Schedule a training session for your team

Remember: Don't hesitate to ask for help! Most hosting providers offer excellent support, and the Modern Agent community is here to help you succeed. 