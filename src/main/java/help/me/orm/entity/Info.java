package help.me.orm.entity;
// Generated Nov 26, 2015 6:04:16 PM by Hibernate Tools 4.3.1.Final

import java.util.regex.Pattern;

import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.FetchType;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.OneToOne;
import javax.persistence.Table;

import org.hibernate.annotations.GenericGenerator;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonProperty;

/**
 * Info generated by hbm2java
 */
@SuppressWarnings("serial")
@Entity
@Table(name = "info")
public class Info implements java.io.Serializable {
	private static final Pattern PHONE_PATTERN = 
			Pattern.compile("\\(\\d{3}\\) \\d{3}-\\d{4}");
	private static final Pattern CITY_NOT_MATCH_PATTERN = 
			Pattern.compile(".+\\d.+");
	private static final Pattern ZIP_PATTERN = 
			Pattern.compile("^\\d{5}(-\\d{4})*?$");

	@JsonIgnore
	private Integer infoId;
	@JsonIgnore
	private User user;
	@JsonIgnore
	private Long createdAt;
	@JsonIgnore
	private Long updatedAt;

	/**
	 * JSON output fields.
	 */
	@JsonProperty("businessName")
	private String businessName;
	@JsonProperty("address")
	private String address;
	@JsonProperty("city")
	private String city; // Should zipcode be used to look up the city / state?
	@JsonProperty("zipcode")
	private String zipcode;
	@JsonProperty("phone")
	private String phoneNumber;
	@JsonProperty("phoneOk")
	private boolean phoneOk;
	@JsonProperty("textOk")
	private boolean textOk;
	@JsonProperty("emailOk")
	private boolean emailOk;

	public Info() {
	}

	/**
	 * @param infoId
	 * @param user
	 * @param businessName
	 * @param address
	 * @param city
	 * @param zipcode
	 * @param phoneNumber
	 * @param phoneOk
	 * @param textOk
	 * @param emailOk
	 * @throws Exception - Telephone, city or zipcode is invalid.
	 */
	public Info(int infoId, User user, String businessName, String address, String city, String zipcode, String phoneNumber, boolean phoneOk,
			boolean textOk, boolean emailOk) throws Exception {
		this.infoId = infoId;
		this.user = user;
		this.businessName = businessName;
		this.address = address;
		this.phoneOk = phoneOk;
		this.textOk = textOk;
		this.emailOk = emailOk;
		
		this.setCity(city);
		this.setZipcode(zipcode);
		this.setPhoneNumber(phoneNumber);
		
		this.createdAt = System.currentTimeMillis();
	}

	/**
	 * @param infoId
	 * @param user
	 * @param address
	 * @param city
	 * @param zipcode
	 * @param phoneNumber
	 * @param phoneOk
	 * @param textOk
	 * @param emailOk
	 * @param createdAt
	 * @param updatedAt
	 * @throws Exception - Telephone number format is invalid.
	 */
	public Info(int infoId, User user, String businessName, String address, String city, String zipcode, String phoneNumber, boolean phoneOk,
			boolean textOk, boolean emailOk, Long createdAt, Long updatedAt) throws Exception {
		this.infoId = infoId;
		this.user = user;
		this.businessName = businessName;
		this.address = address;
		this.phoneOk = phoneOk;
		this.textOk = textOk;
		this.emailOk = emailOk;
		this.createdAt = createdAt;
		this.updatedAt = updatedAt;
		
		this.setCity(city);
		this.setZipcode(zipcode);
		this.setPhoneNumber(phoneNumber);
	}

	@Id
	@GeneratedValue(generator="infoIncrement")
	@GenericGenerator(name="infoIncrement", strategy = "increment")
	@Column(name = "infoId", unique = true, nullable = false)
	public Integer getInfoId() {
		return this.infoId;
	}

	public void setInfoId(int infoId) {
		this.infoId = infoId;
	}

	@JoinColumn(name="user")
	@OneToOne(fetch=FetchType.LAZY, cascade=CascadeType.ALL)
	public User getUser() {
		return this.user;
	}

	public void setUser(User user) {
		this.user = user;
	}

	@Column(name = "address", nullable = false, length = 256)
	public String getAddress() {
		return this.address;
	}

	public void setAddress(String address) {
		this.address = address;
	}
	
	/**
	 * @param businessName
	 */
	@Column(name = "businessName", nullable = true, length = 256)
	public String getBusinessName() {
		return this.businessName;
	}
	
	public void setBusinessName(String businessName) {
		this.businessName = businessName;
	}

	@Column(name = "city", nullable = false, length = 256)
	public String getCity() {
		return this.city;
	}

	/**
	 * Verifies the city does not have any numbers in it.  Not sure if there is any other validation we can do.
	 * 
	 * @param city
	 * @throws Exception
	 */
	public void setCity(String city) {
		if (CITY_NOT_MATCH_PATTERN.matcher(city).matches()) {
			throw new IllegalStateException(String.format("City '%s' should not contain any numbers: %s", city, CITY_NOT_MATCH_PATTERN));
		}
		this.city = city;
	}

	@Column(name = "zipcode", nullable = false, length = 5)
	public String getZipcode() {
		return this.zipcode;
	}

	/**
	 * Verifies the zip code.
	 * @param zipcode
	 * @throws Exception
	 */
	public void setZipcode(String zipcode) {
		if (!ZIP_PATTERN.matcher(zipcode).matches()) {
			throw new IllegalStateException(String.format("Zip code '%s' does not match the expected format: %s", zipcode, ZIP_PATTERN));
		}
		this.zipcode = zipcode;
	}

	@Column(name = "phoneNumber", nullable = false, length = 20)
	public String getPhoneNumber() {
		return this.phoneNumber;
	}

	/**
	 * Verifies the phone number format before setting it.
	 * 
	 * @param phoneNumber
	 * @throws Exception
	 */
	public void setPhoneNumber(String phoneNumber) {
		if (!PHONE_PATTERN.matcher(phoneNumber).matches()) {
			throw new IllegalStateException(String.format("Telephone number '%s' does not match the expected format: %s", phoneNumber, PHONE_PATTERN));
		}
		this.phoneNumber = phoneNumber;
	}

	@Column(name = "phoneOk", nullable = false)
	public boolean isPhoneOk() {
		return this.phoneOk;
	}

	public void setPhoneOk(boolean phoneOk) {
		this.phoneOk = phoneOk;
	}

	@Column(name = "textOk", nullable = false)
	public boolean isTextOk() {
		return this.textOk;
	}

	public void setTextOk(boolean textOk) {
		this.textOk = textOk;
	}

	@Column(name = "emailOk", nullable = false)
	public boolean isEmailOk() {
		return this.emailOk;
	}

	public void setEmailOk(boolean emailOk) {
		this.emailOk = emailOk;
	}

	@Column(name = "created_at", insertable=true, updatable=false)
	public Long getCreatedAt() {
		return this.createdAt;
	}

	public void setCreatedAt(long createdAt) {
		this.createdAt = createdAt;
	}

	@Column(name = "updated_at", insertable=true, updatable=true)
	public Long getUpdatedAt() {
		return this.updatedAt;
	}

	public void setUpdatedAt(long updatedAt) {
		this.updatedAt = updatedAt;
	}

	@Override
	public String toString() {
		StringBuilder builder = new StringBuilder();
		builder.append("Info [infoId=");
		builder.append(infoId);
		builder.append(", user=");
		builder.append(user == null ? null : user.getUserId());
		builder.append(", address=");
		builder.append(address);
		builder.append(", city=");
		builder.append(city);
		builder.append(", zipcode=");
		builder.append(zipcode);
		builder.append(", phoneNumber=");
		builder.append(phoneNumber);
		builder.append(", phoneOk=");
		builder.append(phoneOk);
		builder.append(", textOk=");
		builder.append(textOk);
		builder.append(", emailOk=");
		builder.append(emailOk);
		builder.append(", createdAt=");
		builder.append(createdAt);
		builder.append(", updatedAt=");
		builder.append(updatedAt);
		builder.append("]");
		return builder.toString();
	}


}
