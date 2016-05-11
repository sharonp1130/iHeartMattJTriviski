package help.me.orm.entity;
// Generated Nov 26, 2015 6:04:16 PM by Hibernate Tools 4.3.1.Final

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;
import javax.persistence.UniqueConstraint;

import org.hibernate.annotations.GenericGenerator;
import org.hibernate.search.annotations.Field;

/**
 * Service generated by hbm2java
 */
@SuppressWarnings("serial")
@Entity
@Table(name = "service", uniqueConstraints = @UniqueConstraint(columnNames = "description") )
public class Service implements java.io.Serializable {
	private int serviceId;

	@Field
	private String description;
	private String iconFileName;
	
	public Service() {}
	
	/**
	 * Jackson constructor.
	 * 
	 * @param description
	 */
	public Service(String description) {
		this(-1, description, null);
	}

	public Service(int serviceId, String description, String iconFileName) {
		this.serviceId = serviceId;
		this.description = description;
		this.iconFileName = iconFileName;
	}

	@Id
	@GeneratedValue(generator="serviceIncrement")
	@GenericGenerator(name="serviceIncrement", strategy = "increment")
	@Column(name = "serviceId", unique = true, nullable = false)
	public int getServiceId() {
		return this.serviceId;
	}

	public void setServiceId(int serviceId) {
		this.serviceId = serviceId;
	}

	@Column(name = "description", unique = true, nullable = false, length = 100)
	public String getDescription() {
		return this.description;
	}

	public void setDescription(String description) {
		this.description = description;
	}

	@Column(name = "iconFileName", unique = false, nullable = false, length = 100)
	public String getIconFileName() {
		return this.iconFileName;
	}
	
	public void setIconFileName(String iconFileName) {
		this.iconFileName = iconFileName;
	}
	
	@Override
	public String toString() {
		StringBuilder builder = new StringBuilder();
		builder.append("Service [serviceId=");
		builder.append(serviceId);
		builder.append(", description=");
		builder.append(description);
		builder.append("]");
		return builder.toString();
	}

}
